<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\BuildGalleryImagesPathsAction;
use App\Actions\Image\BuildImagePathAction;
use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\DestroyAllImagesAction;
use App\Actions\Image\DestroyImageAction;
use App\Actions\Image\GetImageAction;
use App\Actions\Image\GetImagesAction;
use App\Actions\Image\ReplaceImageAction;
use App\Actions\Image\ReplaceImageData;
use App\Actions\Image\UpdateImageAction;
use App\Actions\Image\UpdateImageData;
use App\Actions\Portfolio\CreatePortfolioAction;
use App\Actions\Portfolio\CreatePortfolioData;
use App\Actions\Portfolio\GetPortfolioAction;
use App\Actions\Portfolio\GetPortfolioItemsAction;
use App\Actions\Portfolio\UpdatePortfolioAction;
use App\Actions\Portfolio\UpdatePortfolioData;
use App\Actions\PortfolioSection\GetPortfolioSectionsAction;
use App\Actions\Seo\CreateSeoAction;
use App\Actions\Seo\CreateSeoData;
use App\Actions\Seo\GetSeoAction;
use App\Actions\Seo\UpdateSeoAction;
use App\Actions\Seo\UpdateSeoData;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Portfolio;
use App\Http\Requests\PortfolioRequest;
use App\Http\Requests\SearchRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PortfolioController extends Controller
{
    public function index(SearchRequest $request)
    {
        if ($search = $request->validated('search')) {
            $portfolioItems = Portfolio::where('name', 'like', '%' . $search . '%')->paginate(15);
            $portfolioItems->appends(['search' => $search]);
        } else {
            $portfolioItems = Portfolio::paginate(15);
        }

        // $portfolioItems = (new GetPortfolioItemsAction)->run();
        return view('admin.pages.portfolio.index', compact('portfolioItems'));
    }

    public function create()
    {
        $sections = (new GetPortfolioSectionsAction)->run();
        return view('admin.pages.portfolio.create', compact('sections'));
    }

    public function store(PortfolioRequest $request)
    {

        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {
            $seo = (new CreateSeoAction)->run(
                new CreateSeoData(
                    title: $validated['title'],
                    description: $validated['description'],
                    keywords: $validated['keywords'],
                )
            );

            $portfolio = (new CreatePortfolioAction)->run(
                new CreatePortfolioData(
                    name: $validated['name'],
                    h1: $validated['h1'],
                    portfolio_section_id: $validated['portfolio_section_id'],
                    text: $validated['text'],
                    url: $validated['url'],
                    sort_key: $validated['sort_key'],
                    status: $validated['status'],
                    seo_id: $seo->id,
                )
            );

            if ($request->has('avatar')) {
                $avatar_file = $validated['avatar'];

                (new CreateImageAction)->run(
                    $avatar_file,
                    new CreateImageData(
                        image: $avatar_file->getClientOriginalName(),
                        parent_type: 'portfolio_avatar',
                        parent_id: $portfolio->id,
                    )
                );
            }

            if ($request->has('images')) {
                foreach ($validated['images'] as $item) {
                    (new CreateImageAction)->run(
                        $item,
                        new CreateImageData(
                            image: $item->getClientOriginalName(),
                            parent_type: 'portfolio_image',
                            parent_id: $portfolio->id,
                        )
                    );
                }
            }
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }

    public function edit($id)
    {
        $portfolio = (new GetPortfolioAction)->run($id);
        $sections = (new GetPortfolioSectionsAction)->run();
        $seo = (new GetSeoAction)->run($portfolio['seo_id']);
        $avatar = (new GetImageAction)->run($id, parent_type: 'portfolio_avatar');
        $images = (new GetImagesAction)->run($id, parent_type: 'portfolio_image');

        foreach ($images as $key => $image) {
            $images[$key]['path'] = (new BuildImagePathAction)->run($image);
        }

        return view('admin.pages.portfolio.edit', compact('portfolio', 'sections', 'seo', 'avatar', 'images'));
    }

    public function update(PortfolioRequest $request, $id)
    {
        $portfolio = (new GetPortfolioAction)->run($id);
        $seo = (new GetSeoAction)->run($portfolio['seo_id']);

        $validated = $request->validated();

        DB::transaction(function () use ($portfolio, $seo, $validated, $request) {
            (new UpdatePortfolioAction)->run(
                $portfolio,
                new UpdatePortfolioData(
                    name: $validated['name'],
                    h1: $validated['h1'],
                    portfolio_section_id: $validated['portfolio_section_id'],
                    text: $validated['text'],
                    url: $validated['url'],
                    sort_key: $validated['sort_key'],
                    status: $validated['status'],
                )
            );

            (new UpdateSeoAction)->run(
                $seo,
                new UpdateSeoData(
                    title: $validated['title'],
                    description: $validated['description'],
                    keywords: $validated['keywords'],
                )
            );

            if ($request->has('avatar')) {
                $avatar = (new GetImageAction)->run($portfolio->id);
                $avatar_file = $validated['avatar'];

                if ($avatar) {
                    (new ReplaceImageAction)->run(
                        $avatar,
                        $avatar_file,
                        new ReplaceImageData(
                            image: $avatar_file->getClientOriginalName(),
                            parent_type: 'portfolio_avatar',
                            parent_id: $portfolio->id,
                        )
                    );
                }

                if (!$avatar) {
                    (new CreateImageAction)->run(
                        $avatar_file,
                        new CreateImageData(
                            image: $avatar_file->getClientOriginalName(),
                            parent_type: 'portfolio_avatar',
                            parent_id: $portfolio->id,
                        )
                    );
                }
            }

            if ($request->has('images')) {
                foreach ($validated['images'] as $item) {
                    (new CreateImageAction)->run(
                        $item,
                        new CreateImageData(
                            image: $item->getClientOriginalName(),
                            parent_type: 'portfolio_image',
                            parent_id: $portfolio->id,
                        )
                    );
                }
            }

            if ($request->has('edit_images')) {
                foreach ($validated['edit_images'] as $key => $item) {
                    $id = $key;
                    $image = Image::find($id);

                    if (isset($item['del']) && $item['del'] == true) {
                        (new DestroyImageAction())->run($image);
                    } else {
                        (new UpdateImageAction)->run(
                            $image,
                            new UpdateImageData(
                                sort: $item['sort'],
                            )
                        );
                    }
                }
            }
        }, 3);

        Session::flash('success', 'Изменения сохранены');
        return redirect(route('admin.portfolio.index'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $portfolio = (new GetPortfolioAction)->run($id);
            $seo = (new GetSeoAction)->run($portfolio['seo_id']);
            $images = (new GetImagesAction)->run($id, parent_type: 'portfolio_image');

            $portfolio->delete();
            $seo->delete();

            foreach ($images as $image) {
                (new DestroyImageAction)->run($image);
            }
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }

    public function publish($id, Request $request)
    {
        $status = $request->get('published');

        Portfolio::find($id)->update([
            'status' => $status,
            'update_date' => Carbon::now()->toDateTimeString(),
        ]);

        return redirect()->back();
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\BuildGalleryImagesPathsAction;
use App\Actions\Image\BuildAvatarPathAction;
use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\DestroyImageAction;
use App\Actions\Image\GetPortfolioAvatarAction;
use App\Actions\Image\GetPortfolioGalleryAction;
use App\Actions\Image\UpdateImageAction;
use App\Actions\Image\UpdateImageData;
use App\Actions\Portfolio\CreatePortfolioAction;
use App\Actions\Portfolio\CreatePortfolioData;
use App\Actions\Portfolio\GetPortfolioAction;
use App\Actions\Portfolio\GetPortfolioItemsAction;
use App\Actions\Portfolio\UpdatePortfolioAction;
use App\Actions\Portfolio\UpdatePortfolioData;
use App\Actions\PortfolioSection\GetPortfolioSectionsAction;
use App\Actions\SEO\CreateSeoAction;
use App\Actions\SEO\CreateSeoData;
use App\Actions\SEO\GetSeoAction;
use App\Actions\SEO\UpdateSeoAction;
use App\Actions\SEO\UpdateSeoData;
use App\Http\Controllers\Controller;
use App\Requests\PortfolioRequest;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolioItems = (new GetPortfolioItemsAction)->run();
        return view('admin.portfolio.index', compact('portfolioItems'));
    }

    public function create()
    {
        $sections = (new GetPortfolioSectionsAction)->run();
        return view('admin.portfolio.create', compact('sections'));
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

            if ($request->has('image')) {
                $image_file = $validated['image'];

                (new CreateImageAction)->run(
                    $image_file,
                    new CreateImageData(
                        image: $image_file->getClientOriginalName(),
                        parent_type: 'portfolio_avatar',
                        parent_id: $portfolio->id,
                    )
                );
            }
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }

    public function edit($id)
    {
        $portfolio = (new GetPortfolioAction)->run($id);
        $sections = (new GetPortfolioSectionsAction)->run();
        $seo = (new GetSeoAction)->run($portfolio['seo_id']);
        $image = (new GetPortfolioAvatarAction)->run($id);
        $image_path = (new BuildAvatarPathAction)->run($image);

        $gallery_obj = (new GetPortfolioGalleryAction)->run($id);

        $gallery = array_merge([], $gallery_obj->toArray());
        $gallery = (new BuildGalleryImagesPathsAction)->run($id, $gallery);

        return view('admin.portfolio.edit', compact('portfolio', 'sections', 'image_path', 'gallery', 'seo', 'gallery_obj'));
    }

    public function update(PortfolioRequest $request, $id)
    {

        dd($request);

        $request->imageG;



        dd($request);


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

            if ($request->has('image')) {
                $image = (new GetPortfolioAvatarAction)->run($portfolio->id);
                $image_file = $validated['image'];

                if ($image) {
                    (new UpdateImageAction)->run(
                        $image,
                        $image_file,
                        new UpdateImageData(
                            image: $image_file->getClientOriginalName(),
                            parent_type: 'portfolio_avatar',
                            parent_id: $portfolio->id,
                        )
                    );
                }

                if (!$image) {
                    (new CreateImageAction)->run(
                        $image_file,
                        new CreateImageData(
                            image: $image_file->getClientOriginalName(),
                            parent_type: 'portfolio_avatar',
                            parent_id: $portfolio->id,
                        )
                    );
                }
            }
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $portfolio = (new GetPortfolioAction)->run($id);
            $seo = (new GetSeoAction)->run($portfolio['seo_id']);
            $image = (new GetPortfolioAvatarAction)->run($id);

            $portfolio->delete();
            $seo->delete();
            (new DestroyImageAction)->run($image);
        }, 3);

        return redirect(route('admin.portfolio.index'));
    }
}
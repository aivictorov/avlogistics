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
use App\Actions\SEO\CreateSeoAction;
use App\Actions\SEO\CreateSeoData;
use App\Actions\SEO\GetSeoAction;
use App\Actions\SEO\UpdateSeoAction;
use App\Actions\SEO\UpdateSeoData;
use App\Http\Controllers\Controller;
use App\Models\Galleries;
use App\Models\GalleryItems;
use App\Models\Image;
use App\Models\Portfolio;
use App\Requests\PortfolioRequest;
use App\Requests\SearchRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{
    public function index(SearchRequest $request)
    {
        if ($search = $request->validated('search')) {
            $galleries = Galleries::where('name', 'like', '%' . $search . '%')->paginate(15);
            $galleries->appends(['search' => $search]);
        } else {
            $galleries = Galleries::paginate(15);
        }

        // $portfolioItems = (new GetPortfolioItemsAction)->run();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(PortfolioRequest $request)
    {
        // $validated = $request->validated();

        // DB::transaction(function () use ($validated, $request) {
        //     $seo = (new CreateSeoAction)->run(
        //         new CreateSeoData(
        //             title: $validated['title'],
        //             description: $validated['description'],
        //             keywords: $validated['keywords'],
        //         )
        //     );

        //     $portfolio = (new CreatePortfolioAction)->run(
        //         new CreatePortfolioData(
        //             name: $validated['name'],
        //             h1: $validated['h1'],
        //             portfolio_section_id: $validated['portfolio_section_id'],
        //             text: $validated['text'],
        //             url: $validated['url'],
        //             sort_key: $validated['sort_key'],
        //             status: $validated['status'],
        //             seo_id: $seo->id,
        //         )
        //     );

        //     if ($request->has('avatar')) {
        //         $avatar_file = $validated['avatar'];

        //         (new CreateImageAction)->run(
        //             $avatar_file,
        //             new CreateImageData(
        //                 image: $avatar_file->getClientOriginalName(),
        //                 parent_type: 'portfolio_avatar',
        //                 parent_id: $portfolio->id,
        //             )
        //         );
        //     }

        //     if ($request->has('images')) {
        //         foreach ($validated['images'] as $item) {
        //             (new CreateImageAction)->run(
        //                 $item,
        //                 new CreateImageData(
        //                     image: $item->getClientOriginalName(),
        //                     parent_type: 'portfolio_image',
        //                     parent_id: $portfolio->id,
        //                 )
        //             );
        //         }
        //     }
        // }, 3);

        // return redirect(route('admin.galleries.index'));
    }

    public function edit($id)
    {
        $gallery = Galleries::find($id);
        $items = GalleryItems::where('gallery_id', $id)->get()->sortBy('id');

        foreach ($items as $key => $item) {
            $image = Image::where([
                ['parent_type', 'gallery_item'],
                ['parent_id', $item['id']],
            ])->first();

            $items[$key]['image'] = $image;
            // $items[$key]['image'] = (new BuildImagePathAction)->run($image);
        }

        return view('admin.galleries.edit', compact('gallery', 'items'));
    }

    public function update(PortfolioRequest $request, $id)
    {
        // $portfolio = (new GetPortfolioAction)->run($id);
        // $seo = (new GetSeoAction)->run($portfolio['seo_id']);

        // $validated = $request->validated();

        // DB::transaction(function () use ($portfolio, $seo, $validated, $request) {

        //     (new UpdatePortfolioAction)->run(
        //         $portfolio,
        //         new UpdatePortfolioData(
        //             name: $validated['name'],
        //             h1: $validated['h1'],
        //             portfolio_section_id: $validated['portfolio_section_id'],
        //             text: $validated['text'],
        //             url: $validated['url'],
        //             sort_key: $validated['sort_key'],
        //             status: $validated['status'],
        //         )
        //     );

        //     (new UpdateSeoAction)->run(
        //         $seo,
        //         new UpdateSeoData(
        //             title: $validated['title'],
        //             description: $validated['description'],
        //             keywords: $validated['keywords'],
        //         )
        //     );

        //     if ($request->has('avatar')) {
        //         $avatar = (new GetImageAction)->run($portfolio->id);
        //         $avatar_file = $validated['avatar'];

        //         if ($avatar) {
        //             (new ReplaceImageAction)->run(
        //                 $avatar,
        //                 $avatar_file,
        //                 new ReplaceImageData(
        //                     image: $avatar_file->getClientOriginalName(),
        //                     parent_type: 'portfolio_avatar',
        //                     parent_id: $portfolio->id,
        //                 )
        //             );
        //         }

        //         if (!$avatar) {
        //             (new CreateImageAction)->run(
        //                 $avatar_file,
        //                 new CreateImageData(
        //                     image: $avatar_file->getClientOriginalName(),
        //                     parent_type: 'portfolio_avatar',
        //                     parent_id: $portfolio->id,
        //                 )
        //             );
        //         }
        //     }

        //     if ($request->has('images')) {
        //         foreach ($validated['images'] as $item) {
        //             (new CreateImageAction)->run(
        //                 $item,
        //                 new CreateImageData(
        //                     image: $item->getClientOriginalName(),
        //                     parent_type: 'portfolio_image',
        //                     parent_id: $portfolio->id,
        //                 )
        //             );
        //         }
        //     }

        //     if ($request->has('edit_images')) {
        //         foreach ($validated['edit_images'] as $key => $item) {
        //             $id = $key;
        //             $image = Image::find($id);

        //             if (isset ($item['del']) && $item['del'] == true) {
        //                 (new DestroyImageAction())->run($image);
        //             } else {
        //                 (new UpdateImageAction)->run(
        //                     $image,
        //                     new UpdateImageData(
        //                         sort: $item['sort'],
        //                     )
        //                 );
        //             }
        //         }
        //     }
        // }, 3);

        // Session::flash('success', 'Изменения сохранены');
        // // return redirect(route('admin.galleries.edit', ['id' => $id]));
        // return redirect(route('admin.galleries.index'));
    }

    public function destroy($id)
    {
        // DB::transaction(function () use ($id) {
        //     $portfolio = (new GetPortfolioAction)->run($id);
        //     $seo = (new GetSeoAction)->run($portfolio['seo_id']);

        //     $portfolio->delete();
        //     $seo->delete();
        //     (new DestroyAllImagesAction)->run($id);
        // }, 3);

        // return redirect(route('admin.galleries.index'));
    }

    public function publish($id, Request $request)
    {
        // $status = $request->get('published');

        // Portfolio::find($id)->update([
        //     'status' => $status,
        //     'update_date' => Carbon::now()->toDateTimeString(),
        // ]);

        // return redirect()->back();
    }
}
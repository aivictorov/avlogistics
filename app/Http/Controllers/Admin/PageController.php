<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\BuildImagePathAction;
use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\DestroyImageAction;
use App\Actions\Image\GetImageAction;
use App\Actions\Image\ReplaceImageAction;
use App\Actions\Image\ReplaceImageData;
use App\Actions\Page\CreatePageAction;
use App\Actions\Page\CreatePageData;
use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPagesAction;
use App\Actions\Page\UpdatePageAction;
use App\Actions\Page\UpdatePageData;
use App\Actions\SEO\CreateSeoAction;
use App\Actions\SEO\CreateSeoData;
use App\Actions\SEO\GetSeoAction;
use App\Actions\SEO\UpdateSeoAction;
use App\Actions\SEO\UpdateSeoData;
use App\Http\Controllers\Controller;
use App\Requests\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $pages = (new GetPagesAction)->run();
        return view('admin.pages.index', compact('pages'));
    }

    public function create(Request $request)
    {
        $pages = (new GetPagesAction)->run();
        return view('admin.pages.create', compact('pages'));
    }

    public function store(PageRequest $request)
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

            $page = (new CreatePageAction)->run(
                new CreatePageData(
                    name: $validated['name'],
                    h1: $validated['h1'],
                    parent_id: $validated['parent_id'],
                    text: $validated['text'],
                    url: $validated['url'],
                    menu_sort: $validated['menu_sort'],
                    menu_show: $validated['menu_show'],
                    status: $validated['status'],
                    system_page: $validated['system_page'],
                    seo_id: $seo->id,
                )
            );

            if ($request->has('image')) {
                $image_file = $validated['image'];

                (new CreateImageAction)->run(
                    $image_file,
                    new CreateImageData(
                        image: $image_file->getClientOriginalName(),
                        parent_type: 'page_avatar',
                        parent_id: $page->id,
                    )
                );
            }
        }, 3);
        return redirect(route('admin.pages.index'));
    }

    public function edit($id)
    {
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $pages = (new GetPagesAction)->run();
        $avatar = (new GetImageAction)->run($id, parent_type: 'page_avatar');

        return view('admin.pages.edit', compact('page', 'seo', 'pages', 'avatar'));
    }

    public function update(PageRequest $request, $id)
    {
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $validated = $request->validated();

        DB::transaction(function () use ($page, $seo, $validated, $request) {

            (new UpdatePageAction)->run(
                $page,
                new UpdatePageData(
                    name: $validated['name'],
                    h1: $validated['h1'],
                    parent_id: $validated['parent_id'],
                    text: $validated['text'],
                    url: $validated['url'],
                    menu_sort: $validated['menu_sort'],
                    menu_show: $validated['menu_show'],
                    status: $validated['status'],
                    system_page: $validated['system_page'],
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
                $image = (new GetImageAction)->run($page->id);
                $image_file = $validated['image'];

                if ($image) {
                    (new ReplaceImageAction)->run(
                        $image,
                        $image_file,
                        new ReplaceImageData(
                            image: $image_file->getClientOriginalName(),
                            parent_type: 'page_avatar',
                            parent_id: $page->id,
                        )
                    );
                }

                if (!$image) {
                    (new CreateImageAction)->run(
                        $image_file,
                        new CreateImageData(
                            image: $image_file->getClientOriginalName(),
                            parent_type: 'page_avatar',
                            parent_id: $page->id,
                        )
                    );
                }
            }
        }, 3);

        return redirect(route('admin.pages.index'));
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $page = (new GetPageAction)->run($id);
            $seo = (new GetSeoAction)->run($page['seo_id']);
            $image = (new GetImageAction)->run($id);

            $page->delete();
            $seo->delete();
            (new DestroyImageAction)->run($image);
        }, 3);

        return redirect(route('admin.pages.index'));
    }
}
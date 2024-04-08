<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\BuildPageAvatarPathAction;
use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\GetPageAvatarAction;
use App\Actions\Image\UpdateImageAction;
use App\Actions\Image\UpdateImageData;
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
use App\Models\Image;
use App\Requests\Pages\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                $image = (new CreateImageAction)->run(
                    new CreateImageData(
                        image: $validated['image'],
                        create_date: $validated['create_date'],
                        sort: $validated['sort'],
                        parent_type: $validated['parent_type'],
                        parent_id: $validated['parent_id'],
                    )
                );

                Image::savePageAvatar($request->file('image'), $image->id, $page->id);
            }
        }, 3);
        return redirect(route('admin.pages.index'));
    }
    public function edit($id)
    {
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $pages = (new GetPagesAction)->run();
        $image = (new GetPageAvatarAction)->run($id);
        $image_path = (new BuildPageAvatarPathAction)->run($image);

        return view('admin.pages.edit', compact('page', 'image_path', 'seo', 'pages'));
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
                $image = (new GetPageAvatarAction)->run($page->id);

                if ($image) {
                    Storage::deleteDirectory('public/upload/page_avatar/' . $page->id);
                    Image::savePageAvatar($request->file('image'), $image->id, $page->id);

                    (new UpdateImageAction)->run(
                        $image,
                        new UpdateImageData(
                            image: $request->file('image')->getClientOriginalName(),
                            parent_type: 'page_avatar',
                            parent_id: $page->id,
                        )
                    );
                }

                if (!$image) {
                    Image::savePageAvatar($request->file('image'), $image->id, $page->id);

                    $image = (new CreateImageAction)->run(
                        new CreateImageData(
                            image: $validated['image'],
                            create_date: $validated['create_date'],
                            sort: $validated['sort'],
                            parent_type: $validated['parent_type'],
                            parent_id: $validated['parent_id'],
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
            $image = (new GetPageAvatarAction)->run($id);

            $page->delete();
            $seo->delete();

            if ($image) {
                $image->delete();
                Storage::deleteDirectory('public/upload/page_avatar/' . $id);
            }

        }, 3);

        return redirect(route('admin.pages.index'));
    }
}
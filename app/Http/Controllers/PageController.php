<?php

namespace App\Http\Controllers;

use App\Actions\Image\BuildImagePathAction;
use App\Actions\Image\GetImageAction;
use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\Seo\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Models\Galleries;
use App\Models\GalleryItems;
use App\Models\Image;
use App\Models\Page;

class PageController extends Controller
{
    public function show($url)
    {
        $id = (new GetPageIDAction)->run($url);

        if ($id) {
            $page = (new GetPageAction)->run($id);
            $seo = (new GetSeoAction)->run($page['seo_id']);
            $parents = (new GetPageParentsAction)->run($id);

            $children = Page::where([
                ["parent_id", $id],
                ["status", 1],
                ["menu_show", 1]
            ])->get()->sortBy('menu_sort');

            $siblings = Page::where([
                ["parent_id", $page['parent_id']],
                ["status", 1],
                ["menu_show", 1]
            ])->get()->sortBy('menu_sort');

            $image = (new GetImageAction)->run($id);
            $image_path = (new BuildImagePathAction)->run($image);

            $galleries = Galleries::where([
                ['page_id', $id],
                ['status', 1]
            ])->get();

            if ($galleries) {
                foreach ($galleries as $gallery) {
                    $items = GalleryItems::where('gallery_id', $gallery->id)->get()->sortBy('id');

                    foreach ($items as $key => $item) {
                        $image = Image::where([
                            ['parent_type', 'gallery_item'],
                            ['parent_id', $item['id']],
                        ])->first();

                        $items[$key]['image'] = $image;
                    }

                    $gallery['items'] = $items;
                }
            }

            return view('site.pages.page', compact('page', 'parents', 'children', 'siblings', 'image_path', 'seo', 'galleries'));
        } else {
            return response(view('site.pages.error'), 404);
        }
    }
}
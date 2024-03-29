<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\Image;

class PageController extends Controller
{
    public function index()
    {
        return view('site.page');
        // "Страница список постов";
    }

    public function create()
    {
        return "Страница создание поста";
    }

    public function store()
    {
        return "Запрос создание поста";
    }

    public function show($url)
    {
        $page = Page::where('url', $url)->first();

        $image = Image::where([['parent_id', $page->id], ['parent_type', 'page_avatar']])->first();

        if ($image) {
            $image_path = "\\upload\\" . $image->parent_type . "\\" . $image->parent_id . "\\" . $image->id . "\\sizes\\page_" . $image->image;
        } else {
            $image_path = "";
        }

        $parents = array();

        $current_id = $page['parent_id'];

        do {
            $parent =  Page::where('id', $current_id)->first();
            array_unshift($parents, $parent);
            $current_id = $parent['parent_id'];
           
        } while ($current_id > 0);

        return view('site.page', compact('page', 'parents', 'image_path'));
    }

    public function edit()
    {
        return "Страница изменение поста";
    }

    public function update()
    {
        return "Запрос изменение поста";
    }

    public function destroy()
    {
        return "Запрос удаления поста";
    }
}
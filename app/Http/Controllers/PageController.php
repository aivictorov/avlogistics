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

        if(!$page ) {
            return view('site.404');
        }

        $parents = Page::parents($url);
        $image_path = Image::image($page->id);

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
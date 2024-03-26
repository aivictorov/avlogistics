<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class PageController extends Controller
{
    public function index() {
        return view('site.page');
        // "Страница список постов";
    }

    public function create() {
        return "Страница создание поста";
    }

    public function store() {
        return "Запрос создание поста";
    }

    public function show($url) {
        $page = Page::where('url', $url)->first();
        $menu = Page::select('name', 'url')
            ->where([
                ['parent_id', '=', 1],
                ['menu_show', '=', 1],
            ])
            ->get();
        
        return view('site.page', compact('page', 'menu'));
    }

    public function edit() {
        return "Страница изменение поста";
    }

    public function update() {
        return "Запрос изменение поста";
    }

    public function destroy() {
        return "Запрос удаления поста";
    }
}

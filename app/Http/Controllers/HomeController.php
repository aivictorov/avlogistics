<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;


class HomeController extends Controller
{
    public function __invoke()
    {
        $menu = Page::where([
                ['parent_id', '=', 1],
                ['menu_show', '=', 1],
            ])
            ->get();

        return view('site.index', compact('menu'));
    }
}

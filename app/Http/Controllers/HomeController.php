<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\SEO;

class HomeController extends Controller
{
    public function __invoke()
    {
        $page = Page::where('url', 'index')->first();
        $seo = SEO::find($page['seo_id']);

        return view('site.home', compact('seo'));
    }
}

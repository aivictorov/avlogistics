<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\SEO;
use App\Models\Image;

class PageController extends Controller
{
    public function show($url)
    {
        $page = Page::where('url', $url)->first();
        $seo = SEO::find($page['seo_id']);

        if(!$page ) {
            return view('site.404');
        }

        $parents = Page::parents($url);
        $image_path = Image::image($page->id);

        return view('site.page', compact('page', 'parents', 'image_path', 'seo'));
    }
}
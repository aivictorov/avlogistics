<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PortfolioSection;
use Illuminate\Support\Str;
use App\Models\SEO;

class PortfolioController extends Controller
{
    public function index()
    {
        $page = Page::where('url', 'portfolio')->first();
        $parents = Page::parents('portfolio');
        $seo = SEO::find($page['seo_id']);

        $sections = PortfolioSection::select('name')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        foreach ($sections as $key => $section) {
            $sections[$key]['url'] = Str::slug($section['name']);
        }

        return view('portfolio.index', compact('page', 'parents', 'sections', 'seo'));
    }

    public function show()
    {
        // 
    }
}

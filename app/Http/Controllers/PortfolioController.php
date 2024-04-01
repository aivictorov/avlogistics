<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PortfolioSection;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $page = Page::where('url', 'portfolio')->first();
        $parents = Page::parents('portfolio');

        $sections = PortfolioSection::select('name')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        foreach ($sections as $key => $section) {
            $sections[$key]['url'] = Str::slug($section['name']);
        }

        return view('portfolio.index', compact('page', 'parents', 'sections'));
    }

    public function show()
    {
        // 
    }
}

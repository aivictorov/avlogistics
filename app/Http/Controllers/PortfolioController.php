<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\PortfolioSection;
use Illuminate\Support\Str;
use App\Models\SEO;
use App\Models\Image;

class PortfolioController extends Controller
{
    public function index()
    {
        $page = Page::where('url', 'portfolio')->first();
        $parents = Page::parents('portfolio');
        $seo = SEO::find($page['seo_id']);

        $sections = PortfolioSection::select('id', 'name')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        foreach ($sections as $key => $section) {
            $sections[$key]['url'] = Str::slug($section['name']);
        }

        foreach ($sections as $key => $section) {
            $sections[$key]['items'] = Portfolio::where('portfolio_section_id', $section['id'])->get(['id', 'name', 'url'])->toArray();

            foreach ($sections[$key]['items'] as $key2 => $item) {
                $sections[$key]['items'][$key2]['image'] = Image::where([
                    ['parent_type', 'portfolio_avatar'],
                    ['parent_id', $sections[$key]['items'][$key2]['id']],
                ])->first(['id', 'image'])->toArray();
            }
        }

        return view('portfolio.index', compact('page', 'parents', 'sections', 'seo'));
    }

    public function show($url)
    {
        $parents = Page::parents('portfolio');

        $page = Portfolio::where('url', $url)->first();
        $seo = SEO::find($page['seo_id']);

        $sections = PortfolioSection::select('name')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        foreach ($sections as $key => $section) {
            $sections[$key]['url'] = Str::slug($section['name']);
        }

        if (!$page) {
            return view('site.404');
        }

        $avatar = Image::where([
            ['parent_type', 'portfolio_avatar'],
            ['parent_id', $page->id],
        ])->first(['id', 'image'])->toArray();

        $gallery = Image::where([
            ['parent_type', 'portfolio_image'],
            ['parent_id', $page->id],
        ])->get(['id', 'image'])->toArray();

        return view('portfolio.show', compact('page', 'parents','seo', 'sections', 'avatar', 'gallery'));
    }
}

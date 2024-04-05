<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\SEO;
use App\Models\FAQ_Categories;
use App\Models\FAQ_Questions;
use Illuminate\Support\Str;

class FAQController extends Controller
{
    public function index()
    {
        $page = Page::where('url', 'faq')->first();
        $parents = Page::parents('faq');
        $seo = SEO::find($page['seo_id']);

        $faq_categories = FAQ_Categories::select('id', 'name', 'url', 'h1', 'announce')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        foreach ($faq_categories as $key => $category) {
            $faq_categories[$key]['items'] = FAQ_Questions::select('name', 'answer')->where('faq_id', $category['id'])->orderBy('sort')->get()->toArray();

            foreach ($faq_categories[$key]['items'] as $key2 => $item) {
                $faq_categories[$key]['items'][$key2]['url'] = Str::slug($item['name']);
            }
        }

        return view('faq.index', compact('page', 'parents', 'seo', 'faq_categories'));
    }

    public function show($url)
    {
        $page = FAQ_Categories::where('url', $url)->first();

        $faq_page = FAQ_Categories::where('url', $url)->first();

        $parents = Page::parents('faq');
        array_push($parents, Page::where('url', 'faq')->first());

        $seo = SEO::find($faq_page['seo_id']);

        $faq_questions = FAQ_Questions::select('name', 'answer')->where('faq_id', $faq_page['id'])->orderBy('sort')->get()->toArray();

        foreach ($faq_questions as $key => $question) {
            $faq_questions[$key]['url'] = Str::slug($question['name']);
        }

        $faq_categories = FAQ_Categories::select('id', 'name', 'url', 'h1', 'announce')->where('status', 1)->orderBy('sort_key')->get()->toArray();

        return view('faq.show', compact('page', 'faq_page', 'parents', 'seo', 'faq_questions', 'faq_categories'));
    }
}

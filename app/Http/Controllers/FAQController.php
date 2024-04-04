<?php

namespace App\Http\Controllers;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\SEO;

class FAQController extends Controller
{
    public function index(){
        $page = Page::where('url', 'faq')->first();
        $parents = Page::parents('faq');
        $seo = SEO::find($page['seo_id']);

        return view('faq.index', compact('page', 'parents', 'seo'));
    }
}

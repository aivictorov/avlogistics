<?php

namespace App\Http\Controllers;
use App\Models\Page;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(){
        $page = Page::where('url', 'faq')->first();
        $parents = Page::parents('faq');

        return view('faq.index', compact('page', 'parents'));
    }
}

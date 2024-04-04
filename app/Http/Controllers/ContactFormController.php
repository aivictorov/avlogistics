<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\SEO;

class ContactFormController extends Controller
{
    public function __invoke()
    {
        $page = Page::where('url', 'contact')->first();
        $parents = Page::parents('contact');
        $seo = SEO::find($page['seo_id']);

        return view('site.contactForm', compact('page', 'parents', 'seo'));
    }
}

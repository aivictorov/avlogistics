<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class ContactFormController extends Controller
{
    public function __invoke(){
        $page = Page::where('url', 'contact')->first();
        $parents = Page::parents('contact');

        return view('site.contactForm', compact('page', 'parents'));
    }
}

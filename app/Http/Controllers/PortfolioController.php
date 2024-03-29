<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PortfolioController extends Controller
{
    public function index(){
        $page = Page::where('url', 'portfolio')->first();
        $parents = Page::parents('portfolio');

        return view('portfolio.index', compact('page', 'parents'));
    }

    public function show(){
        // 
    }
}

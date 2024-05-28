<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ_Categories;
use App\Models\FAQ_Questions;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\PortfolioSection;
use App\Models\User;

class HomeController extends Controller
{
    public function __invoke()
    {
        $pages_count = Page::all()->count();
        $portfolio_count = Portfolio::all()->count();
        $portfolio_section_count = PortfolioSection::all()->count();
        $faq_count = FAQ_Categories::all()->count();
        $questions_count = FAQ_Questions::all()->count();
        $users_count = User::all()->count();

        return view(
            'admin.pages.home',
            compact(
                'pages_count',
                'portfolio_count',
                'portfolio_section_count',
                'faq_count',
                'questions_count',
                'users_count',
            )
        );
    }
}

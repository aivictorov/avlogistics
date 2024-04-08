<?php

namespace App\Http\Controllers;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIdByUrlAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        $id = (new GetPageIdByUrlAction)->run('index');
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);

        return view('site.home', compact('seo'));
    }
}
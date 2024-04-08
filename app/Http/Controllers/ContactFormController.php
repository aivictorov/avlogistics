<?php

namespace App\Http\Controllers;

use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIdByUrlAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;

class ContactFormController extends Controller
{
    public function __invoke()
    {
        $id = (new GetPageIdByUrlAction)->run('contact');
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $parents = (new GetPageParentsAction)->run($id);

        return view('site.contactForm', compact('page', 'parents', 'seo'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\Image\BuildPageAvatarPathAction;
use App\Actions\Image\GetPageAvatarAction;
use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIdByUrlAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\SEO\GetSeoAction;

class PageController extends Controller
{
    public function show($url)
    {
        $id = (new GetPageIdByUrlAction)->run($url);
        $page = (new GetPageAction)->run($id);
        $seo = (new GetSeoAction)->run($page['seo_id']);
        $parents = (new GetPageParentsAction)->run($id);
        $image = (new GetPageAvatarAction)->run($id);
        $image_path = (new BuildPageAvatarPathAction)->run($image);

        return view('site.page', compact('page', 'parents', 'image_path', 'seo'));
    }
}
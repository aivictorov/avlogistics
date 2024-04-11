<?php

namespace App\Http\Controllers;

use App\Actions\Image\BuildImagePathAction;
use App\Actions\Image\GetImageAction;
use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\Page\GetPageParentsAction;
use App\Actions\SEO\GetSeoAction;

class PageController extends Controller
{
    public function show($url)
    {
        $id = (new GetPageIDAction)->run($url);

        if ($id) {
            $page = (new GetPageAction)->run($id);
            $seo = (new GetSeoAction)->run($page['seo_id']);
            $parents = (new GetPageParentsAction)->run($id);
            $image = (new GetImageAction)->run($id);
            $image_path = (new BuildImagePathAction)->run($image);

            return view('site.page', compact('page', 'parents', 'image_path', 'seo'));
        } else {
            return view('site.404');
        }
    }
}
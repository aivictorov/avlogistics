<?php

namespace App\Actions\Page;

use App\Models\Page;

class GetPageIdByUrlAction
{
    public function run($url)
    {
        $id = Page::where('url', $url)->value('id');

        if (!$id) {
            return view('site.404');
        } else {
            return $id;
        }
    }
}

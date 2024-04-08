<?php

namespace App\Actions\FAQ;

use App\Models\FAQ_Categories;

class GetFaqIdByUrlAction
{
    public function run($url)
    {
        $id = FAQ_Categories::where('url', $url)->value('id');

        if (!$id) {
            return view('site.404');
        } else {
            return $id;
        }
    }
}

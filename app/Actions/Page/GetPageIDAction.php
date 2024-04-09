<?php

namespace App\Actions\Page;

use App\Models\Page;

class GetPageIDAction
{
    public function run($url)
    {
        return Page::where('url', $url)->value('id');
    }
}

<?php

namespace App\Actions\FAQ;

use App\Models\FAQ_Categories;

class GetFaqIDAction
{
    public function run($url)
    {
        return FAQ_Categories::where('url', $url)->value('id');
    }
}

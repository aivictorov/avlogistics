<?php

namespace App\Actions\Faq;

use App\Models\FaqCategories;

class GetFaqIDAction
{
    public function run($url)
    {
        return FaqCategories::where('url', $url)->value('id');
    }
}

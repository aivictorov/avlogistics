<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;

class GetPortfolioIDAction
{
    public function run($url)
    {
        return Portfolio::where('url', $url)->value('id');
    }
}

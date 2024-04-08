<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;

class GetPortfolioIdByUrlAction
{
    public function run($url)
    {
        $id = Portfolio::where('url', $url)->value('id');

        if (!$id) {
            return view('site.404');
        } else {
            return $id;
        }
    }
}

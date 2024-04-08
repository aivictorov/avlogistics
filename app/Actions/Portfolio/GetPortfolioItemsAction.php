<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;
use Carbon\Carbon;

class GetPortfolioItemsAction
{
    public function run()
    {
        $portfolioItems = Portfolio::select('id', 'name', 'update_date', 'status')->orderBy('id')->get()->toArray();

        foreach ($portfolioItems as $key => $item) {
            $portfolioItems[$key]['update_date'] = Carbon::parse($item['update_date'])->toDateString();
        }

        return $portfolioItems;
    }
}

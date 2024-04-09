<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;
use Carbon\Carbon;

class GetPortfolioItemsAction
{
    public function run($sort = 'id')
    {
        $portfolioItems = Portfolio::select('id', 'name', 'update_date', 'status')->get()->sortBy($sort)->toArray();

        foreach ($portfolioItems as $key => $item) {
            $portfolioItems[$key]['update_date'] = Carbon::parse($item['update_date'])->toDateString();
        }

        return $portfolioItems;
    }
}

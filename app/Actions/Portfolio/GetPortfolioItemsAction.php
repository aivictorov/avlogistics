<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;
use Carbon\Carbon;

class GetPortfolioItemsAction
{
    public function run($sort = 'id')
    {
        $portfolioItems = Portfolio::select('id', 'name', 'create_date', 'update_date', 'status')->get()->sortBy($sort);

        return $portfolioItems;
    }
}

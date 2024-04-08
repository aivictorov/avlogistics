<?php

namespace App\Actions\Portfolio;

use App\Models\Portfolio;

class GetPortfolioAction
{
    public function run($id)
    {
        return Portfolio::find($id);
    }
}
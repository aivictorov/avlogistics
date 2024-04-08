<?php

namespace App\Actions\Portfolio;

use App\Actions\Portfolio\CreatePortfolioData;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UpdatePortfolioAction
{
    public function run($portfolio, UpdatePortfolioData $data)
    {
        return $portfolio->update([ 
            'name' => $data->name, 
            'h1' => $data->h1,
            'portfolio_section_id' => $data->portfolio_section_id,
            'text' => $data->text,
            'url' => $data->url,
            'sort_key' => $data->sort_key,
            'status' => $data->status,
        ]);
    }
}
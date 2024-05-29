<?php

namespace App\Actions\Portfolio;

use App\Actions\Portfolio\UpdatePortfolioData;
use Carbon\Carbon;

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

            'update_date' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
<?php

namespace App\Actions\Portfolio;

use App\Actions\Portfolio\CreatePortfolioData;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreatePortfolioAction
{
    public function run(CreatePortfolioData $data)
    {
        return Portfolio::create([ 
            'name' => $data->name, 
            'h1' => $data->h1,
            'portfolio_section_id' => $data->portfolio_section_id,
            'text' => $data->text,
            'url' => $data->url,
            'sort_key' => $data->sort_key,
            'status' => $data->status,

            'seo_id' => $data->seo_id,

            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);
    }
}

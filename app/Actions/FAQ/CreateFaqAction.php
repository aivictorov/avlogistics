<?php

namespace App\Actions\FAQ;

use App\Models\FAQ_Categories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateFaqAction
{
    public function run($data)
    {
        return FAQ_Categories::create([
            'name' => $data->name,
            'h1' => $data->h1,
            'announce' => $data->announce,
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

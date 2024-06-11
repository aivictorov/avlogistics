<?php

namespace App\Actions\Faq;

use App\Actions\Faq\UpdateFaqData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UpdateFaqAction
{
    public function run($faq, UpdateFaqData $data)
    {
        return $faq->update([
            'name' => $data->name,
            'h1' => $data->h1,
            'announce' => $data->announce,
            'url' => $data->url,
            'sort_key' => $data->sort_key,
            'status' => $data->status,

            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);
    }
}



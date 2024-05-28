<?php

namespace App\Actions\Gallery;

use App\Models\Galleries;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateGalleryAction
{
    public function run(CreateGalleryData $data)
    {
        return Galleries::create([
            'name' => $data->name,
            'page_id' => $data->page_id,
            'status' => $data->status,

            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);
    }
}

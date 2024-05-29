<?php

namespace App\Actions\Gallery;

use App\Actions\Gallery\UpdateGalleryItemData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UpdateGalleryItemAction
{
    public function run($item, UpdateGalleryItemData $data)
    {
        return $item->update([
            'text' => $data->text,
            'sort' => $data->sort,

            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);
    }
}


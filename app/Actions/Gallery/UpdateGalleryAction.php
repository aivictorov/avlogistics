<?php

namespace App\Actions\Gallery;

use App\Actions\Gallery\UpdateGalleryData;
use Carbon\Carbon;

class UpdateGalleryAction
{
    public function run($gallery, UpdateGalleryData $data)
    {
        return $gallery->update([
            'name' => $data->name,
            'status' => $data->status,
            'page_id' => $data->page_id,

            'update_date' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
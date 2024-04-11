<?php

namespace App\Actions\Image;

use App\Actions\Image\UpdateImageData;
use Carbon\Carbon;

class UpdateImageAction
{
    public function run($image, UpdateImageData $data)
    {
        $image->update([
            'sort' => $data->sort,
            'update_date' => Carbon::now()->toDateTimeString(),
        ]);

        return;
    }
}
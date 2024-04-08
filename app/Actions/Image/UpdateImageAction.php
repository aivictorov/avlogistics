<?php

namespace App\Actions\Image;

use App\Actions\Image\UpdateImageData;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UpdateImageAction
{
    public function run($image, $image_file, UpdateImageData $data)
    {
        Storage::deleteDirectory('public/upload/' . $image->parent_type . '/' . $image->parent_id);

        $image->update([
            'image' => $data->image,
            'parent_type' => $data->parent_type,
            'parent_id' => $data->parent_id,

            'create_date' => Carbon::now()->toDateTimeString(),
        ]);

        Image::savePageAvatar($image_file, $image->id, $image->parent_id);

        return;
    }
}

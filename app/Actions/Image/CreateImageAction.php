<?php

namespace App\Actions\Image;

use App\Actions\Image\CreateImageData;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CreateImageAction
{
    public function run($image_file, CreateImageData $data)
    {
        $image = Image::create([
            'image' => $data->image,
            'parent_type' => $data->parent_type,
            'parent_id' => $data->parent_id,

            'create_date' => Carbon::now()->toDateTimeString(),
            'sort' => 0,
        ]);

        Image::savePageAvatar($image_file, $image->id, $image->parent_id);

        return;
    }
}
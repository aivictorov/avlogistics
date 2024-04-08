<?php

namespace App\Actions\Image;

use App\Actions\Image\CreateImageData;
use App\Actions\Image\SaveAvatarAction;
use App\Models\Image;
use Carbon\Carbon;

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

        (new SaveAvatarAction)->run($image_file, $image->id, $image->parent_id, $image->parent_type);

        return;
    }
}
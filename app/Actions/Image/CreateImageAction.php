<?php

namespace App\Actions\Image;

use App\Actions\Image\CreateImageData;
use App\Actions\Image\SaveAvatarAction;
use App\Actions\Image\SaveImageAction;
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

        if ($data->parent_type == 'page_avatar' || $data->parent_type == 'portfolio_avatar') {
            (new SaveAvatarAction)->run($image_file, $image->id, $image->parent_id, $image->parent_type);
        } else if ($data->parent_type == 'portfolio_image') {
            (new SaveImageAction)->run($image_file, $image->id, $image->parent_id, $image->parent_type);
        }

        return;
    }
}
<?php

namespace App\Actions\Image;

use App\Actions\Image\CreateImageData;
use App\Models\Image;

class UpdateImageAction
{
    public function run($image, UpdateImageData $data)
    {
        return $image->update([
            'image' => $data->image,
            'parent_type' => $data->parent_type,
            'parent_id' => $data->parent_id,
        ]);
    }
}

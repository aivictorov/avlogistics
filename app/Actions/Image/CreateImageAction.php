<?php

namespace App\Actions\Image;

use App\Actions\Image\CreateImageData;
use App\Models\Image;

class CreateImageAction
{
    public function run(CreateImageData $data)
    {
        return Image::create([
            'image' => $data->image,
            'create_date' => $data->create_date,
            'sort' => $data->sort,
            'parent_type' => $data->parent_type,
            'parent_id' => $data->parent_id,
        ]);
    }
}

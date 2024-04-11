<?php

namespace App\Actions\Image;

use App\Models\Image;

class GetImageAction
{
    public static function run($parent_id, $parent_type = 'page_avatar')
    {
        return Image::where([
            ['parent_type', $parent_type],
            ['parent_id', $parent_id],
        ])->first();
    }
}
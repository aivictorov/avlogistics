<?php

namespace App\Actions\Image;

use App\Models\Image;

class GetPageAvatarAction
{
    public static function run($id)
    {
        return Image::where([
            ['parent_type', 'page_avatar'],
            ['parent_id', $id],
        ])->first();
    }
}
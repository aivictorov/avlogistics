<?php

namespace App\Actions\Image;

use App\Models\Image;

class GetPageAvatarAction
{
    public static function run($id)
    {
        return Image::where([
            ['parent_id', $id],
            ['parent_type', 'page_avatar']
        ])->first();
    }
}
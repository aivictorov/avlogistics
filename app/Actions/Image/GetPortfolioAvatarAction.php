<?php

namespace App\Actions\Image;

use App\Models\Image;

class GetPortfolioAvatarAction
{
    public static function run($id)
    {
        return Image::where([
            ['parent_type', 'portfolio_avatar'],
            ['parent_id', $id],
        ])->first(['id', 'image'])->toArray();
    }
}
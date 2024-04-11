<?php

namespace App\Actions\Image;

use App\Models\Image;

class GetPortfolioImagesAction
{
    public static function run($id)
    {
        return Image::where([
            ['parent_type', 'portfolio_image'],
            ['parent_id', $id],
        ])->get();
    }
}
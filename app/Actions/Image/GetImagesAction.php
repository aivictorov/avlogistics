<?php

namespace App\Actions\Image;

use App\Models\Image;

class GetImagesAction
{
    public function run($parent_id, $parent_type = 'portfolio_image')
    {
        return Image::where([
            ['parent_type', $parent_type],
            ['parent_id', $parent_id],
        ])->get()->sortBy('sort');
    }
}
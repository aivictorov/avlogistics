<?php

namespace App\Actions\Image;

use App\Models\Image;

class GetPortfolioGalleryAction
{
    public function run($id)
    {
        $gallery = Image::where([
            ['parent_type', 'portfolio_image'],
            ['parent_id', $id],
        ])->get();

        return $gallery;
    }
}

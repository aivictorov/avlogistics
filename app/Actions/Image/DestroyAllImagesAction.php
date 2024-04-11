<?php

namespace App\Actions\Image;

use Illuminate\Support\Facades\Storage;

class DestroyAllImagesAction
{
    public function run($id): void
    {
        $image = (new GetPortfolioAvatarAction)->run($id);
        $images = (new GetPortfolioImagesAction)->run($id);

        if ($image) {
            $image->delete();
        }

        foreach ($images as $item) {
            $item->delete();
        }

        Storage::deleteDirectory('public/upload/page_avatar/' . $id);
        Storage::deleteDirectory('public/upload/portfolio_avatar/' . $id);
        Storage::deleteDirectory('public/upload/portfolio_image/' . $id);
    }
}
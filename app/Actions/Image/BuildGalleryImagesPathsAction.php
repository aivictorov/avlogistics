<?php

namespace App\Actions\Image;

class BuildGalleryImagesPathsAction
{
    public function run($id, $gallery)
    {
        if ($gallery) {
            foreach ($gallery as $key => $image) {
                $gallery[$key] = '/storage/upload/portfolio_image/' . $id . '/' . $image['id'] . '/sizes/small_' . $image['image'];
            }
        }

        return $gallery;
    }
}

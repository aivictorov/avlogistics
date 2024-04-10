<?php

namespace App\Actions\Image;

class BuildAvatarPathAction
{
    public function run($image)
    {
        if ($image) {
            $image_path = "\\storage\\upload\\" . $image->parent_type . "\\" . $image->parent_id . "\\" . $image->id . "\\sizes\\page_" . $image->image;
        } else {
            $image_path = "";
        }
        return $image_path;
    }
}

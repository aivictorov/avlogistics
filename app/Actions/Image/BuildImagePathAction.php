<?php

namespace App\Actions\Image;

class BuildImagePathAction
{
    public function run($image)
    {
        if ($image) {
            if ($image->parent_type == 'page_avatar' || $image->parent_type == 'portfolio_avatar') {
                $prefix = 'page_';
            } else if ($image->parent_type == 'portfolio_image') {
                $prefix = 'small_';
            } else if ($image->parent_type == 'gallery_item') {
                $prefix = '1_4';
            }

            return '\\storage\\upload\\' . $image->parent_type . '\\' . $image->parent_id . '\\' . $image->id . '\\sizes\\' . $prefix . $image->image;
        } else {
            return '';
        }
    }
}
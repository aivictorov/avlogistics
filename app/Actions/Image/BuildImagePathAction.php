<?php

namespace App\Actions\Image;

class BuildImagePathAction
{
    public function run($image)
    {
        if ($image) {
            if ($image->parent_type == 'page_avatar' || $image->parent_type == 'portfolio_avatar') {
                $prefix = 'page';
            } else if ($image->parent_type == 'portfolio_image') {
                $prefix = 'small';
            }

            return '\\storage\\upload\\' . $image->parent_type . '\\' . $image->parent_id . '\\' . $image->id . '\\sizes\\' . $prefix . '_' . $image->image;
        } else {
            return '';
        }
    }
}
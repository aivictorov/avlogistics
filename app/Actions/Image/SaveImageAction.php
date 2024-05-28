<?php

namespace App\Actions\Image;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as InterventionImage;

InterventionImage::configure(['driver' => 'imagick']);

class SaveImageAction
{
    public function run($file, $image_id, $page_id, $type)
    {
        if ($type == 'page_avatar') {
            $this->createAndSave($file, [], false, $type, $page_id, $image_id, 'original', '');
            $this->createAndSave($file, ['width' => 670, 'height' => 270], true, $type, $page_id, $image_id, 'sizes', 'page_');
        }

        if ($type == 'portfolio_avatar') {
            $this->createAndSave($file, [], false, $type, $page_id, $image_id, 'original', '');
            $this->createAndSave($file, ['width' => 670, 'height' => 350], true, $type, $page_id, $image_id, 'sizes', 'big_');
            $this->createAndSave($file, ['width' => 500, 'height' => 260], true, $type, $page_id, $image_id, 'sizes', 'page_');
            $this->createAndSave($file, ['width' => 152, 'height' => 80], false, $type, $page_id, $image_id, 'sizes', 'small_');
        }

        if ($type == 'portfolio_image') {
            $this->createAndSave($file, [], false, $type, $page_id, $image_id, 'original', '');
            $this->createAndSave($file, ['width' => 670, 'height' => 350], true, $type, $page_id, $image_id, 'sizes', 'big_');
            $this->createAndSave($file, ['width' => 152, 'height' => 80], false, $type, $page_id, $image_id, 'sizes', 'small_');
        }

        if ($type == 'gallery_item') {
            $this->createAndSave($file, [], false, $type, $page_id, $image_id, 'original', '');
            $this->createAndSave($file, ['width' => 940, 'height' => 600], true, $type, $page_id, $image_id, 'sizes', 'big');
            $this->createAndSave($file, ['width' => 152, 'height' => 80], false, $type, $page_id, $image_id, 'sizes', '1_4');
        }

        return;
    }

    public static function createAndSave($file, $size, $watermark, $type, $page_id, $image_id, $folder, $prefix)
    {
        $image = InterventionImage::make($file);

        if (count($size) > 0) {
            $image->fit($size['width'], $size['height']);
        }

        if ($watermark) {
            $watermark = InterventionImage::make(public_path('images/watermarks/watermark.png'));
            $image->insert($watermark, 'center');

            $mini_watermark = InterventionImage::make(public_path('images/watermarks/mini-watermark.png'));
            $image->insert($mini_watermark, 'bottom-right');
        }

        if ($prefix != "") {
            // $prefix = $prefix . '_';
        }

        $dirPath = 'public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/' . $folder;
        $imgPath = storage_path('app/' . $dirPath . '/' . $prefix . str_replace(' ', '-', $file->getClientOriginalName()));

        Storage::makeDirectory($dirPath);
        $image->save($imgPath);
    }
}

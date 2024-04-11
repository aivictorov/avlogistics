<?php

namespace App\Actions\Image;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as InterventionImage;

InterventionImage::configure(['driver' => 'imagick']);

class SaveImageAction
{
    public function run($file, $image_id, $page_id, $type)
    {
        $image = InterventionImage::make($file);

        Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/original');
        $original_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/original/' . $file->getClientOriginalName());
        $image->save($original_image_path);

        // 




        $image_big = $image->fit(670, 350);

        $watermark = InterventionImage::make(public_path('images/watermark.png'));
        $image_big->insert($watermark, 'center');

        $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
        $image_big->insert($mini_watermark, 'bottom-right');

        Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
        $big_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'big_' . $file->getClientOriginalName());
        $image_big->save($big_image_path);

        // 

        $image_small = $image->fit(670, 350);

        $watermark = InterventionImage::make(public_path('images/watermark.png'));
        $image_big->insert($watermark, 'center');

        $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
        $image_big->insert($mini_watermark, 'bottom-right');

        Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
        $small_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'small_' . $file->getClientOriginalName());
        $image_small->save($small_image_path);

        return;
    }
}

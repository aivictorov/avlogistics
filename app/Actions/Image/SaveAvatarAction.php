<?php

namespace App\Actions\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as InterventionImage;

InterventionImage::configure(['driver' => 'imagick']);

class SaveAvatarAction
{
    public function run($file, $image_id, $page_id, $type)
    {
        $image = InterventionImage::make($file);

        Storage::makeDirectory('public/upload/'. $type .'/' . $page_id . '/' . $image_id . '/original');
        $original_image_path = storage_path('app/public/upload/'. $type .'/' . $page_id . '/' . $image_id . '/original/' . $file->getClientOriginalName());
        $image->save($original_image_path);

        $image->fit(670, 270);

        $watermark = InterventionImage::make(public_path('images/watermark.png'));
        $image->insert($watermark, 'center');

        $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
        $image->insert($mini_watermark, 'bottom-right');

        Storage::makeDirectory('public/upload/'. $type .'/' . $page_id . '/' . $image_id . '/sizes');
        $page_image_path = storage_path('app/public/upload/'. $type .'/' . $page_id . '/' . $image_id . '/sizes/' . 'page_' . $file->getClientOriginalName());
        $image->save($page_image_path);

        return;
    }
}

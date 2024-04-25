<?php

namespace App\Actions\Image;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as InterventionImage;

InterventionImage::configure(['driver' => 'imagick']);

class SaveImageAction
{
    public function run($file, $image_id, $page_id, $type)
    {

        if ($type == 'page_avatar') {

            // original --->
            $original_image = InterventionImage::make($file);

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/original');

            $original_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/original/' . str_replace(' ', '-', $file->getClientOriginalName()));

            $original_image->save($original_image_path);
            // original <---

            // page --->
            $page_image = InterventionImage::make($file);

            $page_image->fit(670, 270);

            $watermark = InterventionImage::make(public_path('images/watermark.png'));
            $page_image->insert($watermark, 'center');

            $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
            $page_image->insert($mini_watermark, 'bottom-right');

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
            $page_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'page_' . str_replace(' ', '-', $file->getClientOriginalName()));
            $page_image->save($page_image_path);
            // page <---

        }

        if ($type == 'portfolio_avatar') {

            // original --->
            $original_image = InterventionImage::make($file);

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/original');

            $original_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/original/' . str_replace(' ', '-', $file->getClientOriginalName()));

            $original_image->save($original_image_path);
            // original <---

            // big --->
            $big_image = InterventionImage::make($file);

            $big_image->fit(670, 350);

            $watermark = InterventionImage::make(public_path('images/watermark.png'));
            $big_image->insert($watermark, 'center');

            $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
            $big_image->insert($mini_watermark, 'bottom-right');

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
            $big_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'big_' . str_replace(' ', '-', $file->getClientOriginalName()));
            $big_image->save($big_image_path);
            // big <---

            // page --->
            $page_image = InterventionImage::make($file);

            $page_image->fit(500, 260);

            $watermark = InterventionImage::make(public_path('images/watermark.png'));
            $page_image->insert($watermark, 'center');

            $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
            $page_image->insert($mini_watermark, 'bottom-right');

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
            $page_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'page_' . str_replace(' ', '-', $file->getClientOriginalName()));
            $page_image->save($page_image_path);
            // page <---

            // small --->
            $small_image = InterventionImage::make($file);

            $small_image->fit(152, 80);

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
            $small_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'small_' . str_replace(' ', '-', $file->getClientOriginalName()));
            $small_image->save($small_image_path);
            // small <---
        }

        if ($type == 'portfolio_image') {

            // original --->
            $original_image = InterventionImage::make($file);

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/original');

            $original_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/original/' . str_replace(' ', '-', $file->getClientOriginalName()));

            $original_image->save($original_image_path);
            // original <---

            // big --->
            $big_image = InterventionImage::make($file);

            $big_image->fit(670, 350);

            $watermark = InterventionImage::make(public_path('images/watermark.png'));
            $big_image->insert($watermark, 'center');

            $mini_watermark = InterventionImage::make(public_path('images/mini-watermark.png'));
            $big_image->insert($mini_watermark, 'bottom-right');

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
            $big_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'big_' . str_replace(' ', '-', $file->getClientOriginalName()));
            $big_image->save($big_image_path);
            // big <---

            // small --->
            $small_image = InterventionImage::make($file);

            $small_image->fit(152, 80);

            Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
            $small_image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'small_' . str_replace(' ', '-', $file->getClientOriginalName()));
            $small_image->save($small_image_path);
            // small <---
        }

        return;
    }

    // public static function createImage($file, $width, $height, $addWatermark)
    // {
    //     $image = InterventionImage::make($file);

    //     $image->fit($width, $height);

    //     if ($addWatermark) {
    //         $watermark = InterventionImage::make(public_path('images/watermark.png'));
    //         $image->insert($watermark, 'center');

    //         $watermark_small = InterventionImage::make(public_path('images/mini-watermark.png'));
    //         $image->insert($watermark_small, 'bottom-right');
    //     }

    //     return $image;
    // }

    // public static function saveImage($image, $type, $page_id,  $image_id, $prefix)
    // {



    //     Storage::makeDirectory('public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes');
    //     $image_path = storage_path('app/public/upload/' . $type . '/' . $page_id . '/' . $image_id . '/sizes/' . 'big_' . str_replace(' ', '-', $file->getClientOriginalName()));
    //     $image->save($image_path);

    // }



}

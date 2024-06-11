<?php

namespace App\Actions\Image;

use Illuminate\Support\Facades\Storage;

class DestroyImageAction
{
    public function run($image): void
    {
        if ($image) {
            $image->delete();
            Storage::deleteDirectory('public/upload/' . $image->parent_type . '/' . $image->parent_id . '/' . $image->id);

            $files = Storage::allFiles('public/upload/' . $image->parent_type . '/' . $image->parent_id);
            if (empty($files)) {
                Storage::deleteDirectory('public/upload/' . $image->parent_type . '/' . $image->parent_id);
            }
        }
    }
}
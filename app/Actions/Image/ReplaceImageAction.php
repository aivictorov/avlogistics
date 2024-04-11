<?php

namespace App\Actions\Image;

use App\Actions\Image\SaveAvatarAction;
use App\Actions\Image\ReplaceImageData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ReplaceImageAction
{
    public function run($image, $image_file, ReplaceImageData $data)
    {
        Storage::deleteDirectory('public/upload/' . $image->parent_type . '/' . $image->parent_id);

        $image->update([
            'image' => $data->image,
            'parent_type' => $data->parent_type,
            'parent_id' => $data->parent_id,

            'create_date' => Carbon::now()->toDateTimeString(),
        ]);

        (new SaveAvatarAction)->run($image_file, $image->id, $image->parent_id, $image->parent_type);

        return;
    }
}

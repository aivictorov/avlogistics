<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\DestroyImageAction;
use App\Http\Controllers\Controller;
use App\Models\Image;

class AjaxController extends Controller
{
    public function destroy_image()
    {
        $result = json_decode(file_get_contents('php://input'));

        $image = Image::find($result->id);

        (new DestroyImageAction)->run($image);

        return $image->image;

        // return json_decode(file_get_contents('php://input'));
    }

    public function drag_and_drop()
    {
        return 'drag_and_drop';
    }
}
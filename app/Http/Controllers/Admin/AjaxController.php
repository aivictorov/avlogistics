<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\DestroyImageAction;
use App\Actions\Image\UpdateImageAction;
use App\Actions\Image\UpdateImageData;
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
        $result = json_decode(file_get_contents('php://input'));

        foreach ($result as $item) {
            $image = Image::find($item->id);

            (new UpdateImageAction)->run(
                $image,
                new UpdateImageData(
                    sort: $item->sort,
                )
            );
        }

        return $result;
    }

    public function load_img()
    {

        foreach ($_FILES["images"]["name"] as $key => $value) {
            echo $_FILES["images"]["name"][$key] . '   ';
        }

        return;
        // return $_POST['images']['name'];



    }
}
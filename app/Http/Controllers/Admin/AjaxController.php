<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\DestroyImageAction;
use App\Actions\Image\UpdateImageAction;
use App\Actions\Image\UpdateImageData;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Requests\ImageRequest;
use App\Requests\ImagesRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as InterventionImage;

InterventionImage::configure(['driver' => 'imagick']);

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

    public function load_img(ImagesRequest $request)
    {
        $validated = $request->validated();

        if ($request->has('images')) {
            $images = $validated['images'];

            $result = [];

            foreach ($images as $image_file) {
                $image = (new CreateImageAction)->run(
                    $image_file,
                    new CreateImageData(
                        image: $image_file->getClientOriginalName(),
                        parent_type: 'portfolio_image',
                        parent_id: $_POST['page_id'],
                    )
                );

                array_push($result, $image);
            }
        }

        return $result;
    }

    public function load_content_img(ImageRequest $request)
    {
        $validated = $request->validated();

        $file = $validated['file'];

        $image = InterventionImage::make($file);

        Storage::makeDirectory('public/upload/context_images/');
        $original_image_path = storage_path('app/public/upload/context_images/' . $file->getClientOriginalName());
        $image->save($original_image_path);

        return 'load_content_img OK';
    }

    public function remove_content_img()
    {
        $filename = file_get_contents('php://input');
        Storage::delete('public/upload/context_images/' . $filename);

        return 'remove_content_img OK';
    }

}
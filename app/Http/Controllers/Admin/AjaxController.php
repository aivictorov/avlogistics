<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\DestroyImageAction;
use App\Actions\Image\GetImageAction;
use App\Actions\Image\ReplaceImageAction;
use App\Actions\Image\ReplaceImageData;
use App\Actions\Image\UpdateImageAction;
use App\Actions\Image\UpdateImageData;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Page;
use App\Requests\ImageRequest;
use App\Requests\ImagesRequest;
use App\Requests\UpdateAvatarRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as InterventionImage;

InterventionImage::configure(['driver' => 'imagick']);

class AjaxController extends Controller
{
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $validated = $request->validated();

        $page_id = $validated['page_id'];
        $page_type = $validated['page_type'];
        $avatar_file = $validated['avatar_file'];

        $avatar = (new GetImageAction)->run($page_id);

        if ($avatar) {
            $result = (new ReplaceImageAction)->run(
                $avatar,
                $avatar_file,
                new ReplaceImageData(
                    image: $avatar_file->getClientOriginalName(),
                    parent_type: $page_type . '_avatar',
                    parent_id: $page_id,
                )
            );
        }

        if (!$avatar) {
            $result = (new CreateImageAction)->run(
                $avatar_file,
                new CreateImageData(
                    image: $avatar_file->getClientOriginalName(),
                    parent_type: $page_type . '_avatar',
                    parent_id: $page_id,
                )
            );
        }

        return Image::path($result);
    }


    public function destroyImage()
    {
        $result = json_decode(file_get_contents('php://input'));
        $image = Image::find($result->id);

        (new DestroyImageAction)->run($image);

        return $image->image;
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

    public function toggle_status(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $status = $request->get('status');

        if ($type == 'page') {
            Page::find($id)->update([
                'status' => $status,
                'update_date' => Carbon::now()->toDateTimeString(),
            ]);
        }

        return redirect()->back();
    }




}
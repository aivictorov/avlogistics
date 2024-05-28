<?php

namespace App\Http\Controllers\Admin;

use App\Actions\FAQ\saveQuestionAction;
use App\Actions\FAQ\saveQuestionData;
use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\DestroyImageAction;
use App\Actions\Image\GetImageAction;
use App\Actions\Image\ReplaceImageAction;
use App\Actions\Image\ReplaceImageData;
use App\Actions\Image\UpdateImageAction;
use App\Actions\Image\UpdateImageData;
use App\Http\Controllers\Controller;
use App\Models\FAQ_Questions;
use App\Models\GalleryItems;
use App\Models\Image;
use App\Models\Page;
use App\Requests\ImageRequest;
use App\Requests\ImagesRequest;
use App\Requests\QuestionRequest;
use App\Requests\UpdateAvatarRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $parent_type = $page_type . '_avatar';

        $avatar = (new GetImageAction)->run($page_id, $parent_type);

        if ($avatar) {
            $result = (new ReplaceImageAction)->run(
                $avatar,
                $avatar_file,
                new ReplaceImageData(
                    image: str_replace(' ', '-', $avatar_file->getClientOriginalName()),
                    parent_type: $page_type . '_avatar',
                    parent_id: $page_id,
                )
            );
        }

        if (!$avatar) {
            $result = (new CreateImageAction)->run(
                $avatar_file,
                new CreateImageData(
                    image: str_replace(' ', '-', $avatar_file->getClientOriginalName()),
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

    public function saveGallerySort()
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

    public function addImagesToPortfolio(ImagesRequest $request)
    {
        $validated = $request->validated();

        $page_id = $validated['page_id'];
        $page_type = $validated['page_type'];
        $image_files = $validated['images'];

        $result = [];

        foreach ($image_files as $image_file) {
            $image = (new CreateImageAction)->run(
                $image_file,
                new CreateImageData(
                    image: str_replace(' ', '-', $image_file->getClientOriginalName()),
                    parent_type: $page_type . '_image',
                    parent_id: $page_id,
                )
            );

            array_push($result, Image::path($image, "small"));
        }

        return $result;
    }

    public function saveQuestion(QuestionRequest $request)
    {
        $validated = $request->validated();

        $result = (new saveQuestionAction)->run(
            new saveQuestionData(
                id: $validated['id'],
                name: $validated['name'],
                answer: $validated['answer'],
                sort: $validated['sort'],
                faq_id: $validated['faq_id'],
            )
        );

        return $result;
    }

    public function removeQuestion()
    {
        $id = file_get_contents('php://input');

        $question = FAQ_Questions::find($id);
        $question->delete();

        return 'question ' . $id . ' removed';
    }


    public function removeGalleryItem()
    {
        $id = file_get_contents('php://input');
        $item = GalleryItems::find($id);

        $image = Image::where([
            ['parent_type', 'gallery_item'],
            ['parent_id', $id],
        ])->first();

        $res = $image->id;

        DB::transaction(function () use ($item, $image) {
            (new DestroyImageAction)->run($image);
            $item->delete();
        }, 3);

        return 'gallery item ' . $res . ' removed';
    }
}
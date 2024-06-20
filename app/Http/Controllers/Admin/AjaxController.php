<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Faq\SaveQuestionAction;
use App\Actions\Faq\SaveQuestionData;
use App\Actions\Gallery\CreateGalleryItemAction;
use App\Actions\Gallery\CreateGalleryItemData;
use App\Actions\Gallery\UpdateGalleryAction;
use App\Actions\Gallery\UpdateGalleryData;
use App\Actions\Gallery\UpdateGalleryItemAction;
use App\Actions\Gallery\UpdateGalleryItemData;
use App\Actions\Image\CreateImageAction;
use App\Actions\Image\CreateImageData;
use App\Actions\Image\DestroyImageAction;
use App\Actions\Image\GetImageAction;
use App\Actions\Image\ReplaceImageAction;
use App\Actions\Image\ReplaceImageData;
use App\Actions\Image\UpdateImageAction;
use App\Actions\Image\UpdateImageData;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryItemRequest;
use App\Http\Requests\GalleryRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\ImagesRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Models\FaqQuestions;
use App\Models\GalleryItems;
use App\Models\Image;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
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

            array_push($result, Image::path($image, "small_"));
        }

        return $result;
    }

    public function saveQuestion(QuestionRequest $request)
    {
        $validated = $request->validated();

        $result = (new SaveQuestionAction)->run(
            new SaveQuestionData(
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

        $question = FaqQuestions::find($id);
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

    public function updateGalleryItem(GalleryItemRequest $request)
    {
        $validated = $request->validated();
        $galleryItem = GalleryItems::find($validated['id']);

        $galleryItem->update([
            'text' => $validated['text'],
            'sort' => $validated['sort'],
            'portfolio_id' => $validated['portfolio_id'],
            'update_date' => Carbon::now()->toDateTimeString(),
        ]);

        return 'updated';
    }

    public function addImagesToGallery(ImagesRequest $request)
    {
        $validated = $request->validated();

        $gallery_id = $validated['page_id'];
        // $parent_type = $validated['page_type'];

        $image_files = $validated['images'];

        $result = [];

        foreach ($image_files as $image_file) {
            $galleryItem = (new CreateGalleryItemAction)->run(
                new CreateGalleryItemData(
                    gallery_id: $gallery_id,
                    text: "",
                    sort: 0,
                    portfolio_id: null,
                )
            );

            $image = (new CreateImageAction)->run(
                $image_file,
                new CreateImageData(
                    image: $image_file->getClientOriginalName(),
                    parent_type: 'gallery_item',
                    parent_id: $galleryItem->id,
                )
            );

            array_push($result, Image::path($image, "1_4"));
        }

        return $result;
    }
}
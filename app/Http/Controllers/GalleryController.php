<?php

namespace App\Http\Controllers;

use App\Actions\Image\BuildImagePathAction;
use App\Actions\Page\GetPageAction;
use App\Actions\Page\GetPageIDAction;
use App\Actions\SEO\GetSeoAction;
use App\Http\Controllers\Controller;
use App\Models\Galleries;
use App\Models\GalleryItems;
use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __invoke()
    {
        $id = file_get_contents('php://input');

        $gallery = Galleries::find($id);
        $items = GalleryItems::where('gallery_id', $gallery->id)->get()->sortBy('id');

        foreach ($items as $key => $item) {
            $image = Image::where([
                ['parent_type', 'gallery_item'],
                ['parent_id', $item['id']],
            ])->first();

            $items[$key]['image'] = $image;
            $items[$key]['image']['path'] = (new BuildImagePathAction)->run($image);
        }

        return json_encode($items);
    }
}
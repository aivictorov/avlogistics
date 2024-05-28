<?php

namespace App\Actions\Gallery;

use App\Actions\Gallery\CreateGalleryItemData;
use App\Models\GalleryItems;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateGalleryItemAction
{
    public function run(CreateGalleryItemData $data)
    {
        return GalleryItems::create([
            'gallery_id' => $data->gallery_id,
            'text' => $data->text,
            'sort' => $data->sort,
            'portfolio_id' => $data->portfolio_id,

            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);
    }
}


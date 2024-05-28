<?php

namespace App\Actions\Gallery;

class CreateGalleryItemData
{
    public function __construct(
        public $gallery_id,
        public $text,
        public $sort,
        public $portfolio_id,
    ) {
        //
    }
}
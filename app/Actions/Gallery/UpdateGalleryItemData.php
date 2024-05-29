<?php

namespace App\Actions\Gallery;

class UpdateGalleryItemData
{
    public function __construct(
        public $text,
        public $sort,
    ) {
        //
    }
}
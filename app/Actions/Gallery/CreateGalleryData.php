<?php

namespace App\Actions\Gallery;

class CreateGalleryData
{
    public function __construct(
        public $name,
        public $page_id,
        public $status,
    ) {
        //
    }
}

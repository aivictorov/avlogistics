<?php

namespace App\Actions\Gallery;

class CreateGalleryData
{
    public function __construct(
        public $name,
        public $status,
        public $page_id,
    ) {
        //
    }
}

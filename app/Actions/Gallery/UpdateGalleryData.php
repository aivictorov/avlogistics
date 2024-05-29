<?php

namespace App\Actions\Gallery;

class UpdateGalleryData
{
    public function __construct(
        public $name,
        public $page_id,
        public $status,
    ) {
        //
    }
}

<?php

namespace App\Actions\Image;

use Carbon\Carbon;

class UpdateImageData
{
    public function __construct(
        public $image,
        public $parent_type,
        public $parent_id,
    ) {
        //
    }
}

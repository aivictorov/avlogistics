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
        $this->sort = 0;
        $this->create_date = Carbon::now()->toDateTimeString();
    }
}

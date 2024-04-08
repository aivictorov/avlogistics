<?php

namespace App\Actions\Image;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateImageData
{
    public function __construct(
        public $image,
        public $parent_type,
        public $parent_id,
    ) {
        //
    }
}
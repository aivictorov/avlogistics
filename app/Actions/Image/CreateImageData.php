<?php

namespace App\Actions\Image;

class CreateImageData
{
    public function __construct(
        public $image,
        public $create_date,
        public $sort,
        public $parent_type,
        public $parent_id,
    ) {
        
    }
}

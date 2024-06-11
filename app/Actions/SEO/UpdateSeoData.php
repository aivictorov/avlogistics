<?php

namespace App\Actions\Seo;

class UpdateSeoData
{
    public function __construct(
        public $title,
        public $description,
        public $keywords,
    ) {
        //
    }
}

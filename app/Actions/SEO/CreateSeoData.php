<?php

namespace App\Actions\Seo;

class CreateSeoData
{
    public function __construct(
        public $title,
        public $description,
        public $keywords,
    ) {
        //
    }
}

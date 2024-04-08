<?php

namespace App\Actions\SEO;

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

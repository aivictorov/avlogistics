<?php

namespace App\Actions\SEO;

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

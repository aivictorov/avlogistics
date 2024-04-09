<?php

namespace App\Actions\FAQ;

class UpdateFaqData
{
    public function __construct(
        public $name,
        public $h1,
        public $announce,
        public $url,
        public $sort_key,
        public $status,
    ) {
        //
    }
}
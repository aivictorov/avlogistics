<?php

namespace App\Actions\FAQ;

class CreateFaqData
{
    public function __construct(
        public $name,
        public $h1,
        public $announce,
        public $url,
        public $sort_key,
        public $status,
        public $seo_id,

        // public $create_date,
        // public $update_date,
        // public $user_id,
    ) {
        //
    }
}
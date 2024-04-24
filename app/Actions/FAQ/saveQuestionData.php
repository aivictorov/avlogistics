<?php

namespace App\Actions\FAQ;

class saveQuestionData
{
    public function __construct(
        public $id,
        public $name,
        public $answer,
        public $sort,
        public $faq_id,
    ) {
        //
    }
}
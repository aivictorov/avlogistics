<?php

namespace App\Actions\Faq;

class SaveQuestionData
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
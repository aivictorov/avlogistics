<?php

namespace App\Actions\FAQ;

class CreateQuestionData
{
    public function __construct(
        public string $name,
        public string $answer,
        public int $sort,
        public int $faq_id,
    ) {
        //
    }
}

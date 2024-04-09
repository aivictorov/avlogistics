<?php

namespace App\Actions\FAQ;

class CreateQuestionData
{
    public function __construct(
        public string $name,
        public string $answer,
        // public string $create_date,
        // public string $update_date,
        // public int $user_id,
        public int $faq_id,
        // public int $file_id,
        // public int $sort,
    ) {
        //
    }
}

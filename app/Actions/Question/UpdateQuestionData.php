<?php

namespace App\Actions\Question;

class UpdateQuestionData
{
    public function __construct(
        public string $name,
        public string $answer,
        public int $sort,
    ) {
        //
    }
}

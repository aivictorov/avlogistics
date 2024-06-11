<?php

namespace App\Actions\Question;

use App\Models\FaqQuestions;
use Illuminate\Support\Str;

class GetQuestionsAction
{
    public function run($id)
    {
        $faq_questions = FaqQuestions::where('faq_id', $id)
            ->orderBy('sort')
            ->get();

        foreach ($faq_questions as $key => $question) {
            $faq_questions[$key]['url'] = Str::slug($question['name']);
        }

        return $faq_questions;
    }
}

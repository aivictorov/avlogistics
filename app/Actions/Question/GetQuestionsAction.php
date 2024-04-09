<?php

namespace App\Actions\Questions;

use App\Models\FAQ_Questions;
use Illuminate\Support\Str;

class GetQuestionsAction
{
    public function run($id)
    {
        $faq_questions = FAQ_Questions::where('faq_id', $id)
            ->orderBy('sort')
            ->get();
        // ->toArray();

        foreach ($faq_questions as $key => $question) {
            $faq_questions[$key]['url'] = Str::slug($question['name']);
        }

        return $faq_questions;
    }
}

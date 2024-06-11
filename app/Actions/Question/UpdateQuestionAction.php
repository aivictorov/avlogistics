<?php

namespace App\Actions\Question;

use App\Models\FaqQuestions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UpdateQuestionAction
{
    public function run($question, UpdateQuestionData $data)
    {
        return $question->update([
            'name' => $data->name,
            'answer' => $data->answer,
            'sort' => $data->sort,

            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ]);
    }
}

<?php

namespace App\Actions\Questions;

use App\Models\FAQ_Questions;
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

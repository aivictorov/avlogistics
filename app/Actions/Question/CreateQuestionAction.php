<?php

namespace App\Actions\Question;

use App\Models\FaqQuestions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateQuestionAction
{
    public function run($data)
    {
        return FaqQuestions::create([
            'name' => $data->name,
            'answer' => $data->answer,
            'sort' => $data->sort,
            'faq_id' => $data->faq_id,

            'create_date' => Carbon::now()->toDateTimeString(),
            'update_date' => Carbon::now()->toDateTimeString(),
            'user_id' => Auth::user()->id,
            'file_id' => 0,
        ]);
    }
}

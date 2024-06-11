<?php

namespace App\Actions\Faq;

use App\Actions\Faq\UpdateFaqData;
use App\Models\FaqQuestions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SaveQuestionAction
{
    public function run(SaveQuestionData $data)
    {
        $question = FaqQuestions::find($data->id);

        if ($question) {
            $result = $question->update([
                'name' => $data->name,
                'answer' => $data->answer,
                'sort' => $data->sort,
                'faq_id' => $data->faq_id,

                'update_date' => Carbon::now()->toDateTimeString(),
                'user_id' => Auth::user()->id,
                'file_id' => 0,
            ]);
        } else {
            $result = FaqQuestions::create([
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

        return $result;
    }
}
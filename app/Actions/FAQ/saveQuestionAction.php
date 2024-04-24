<?php

namespace App\Actions\FAQ;

use App\Actions\FAQ\UpdateFaqData;
use App\Models\FAQ_Questions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class saveQuestionAction
{
    public function run(saveQuestionData $data)
    {
        $question = FAQ_Questions::find($data->id);

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
            $result = FAQ_Questions::create([
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
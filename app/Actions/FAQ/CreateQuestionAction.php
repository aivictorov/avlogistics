<?php

namespace App\Actions\FAQ;

use App\Models\FAQ_Questions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateQuestionAction
{
    public function run($data)
    {
        return FAQ_Questions::create([
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

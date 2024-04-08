<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class FaqRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'h1' => ['required'],
            'announce' => ['required'],
            'url' => ['required'],
            'sort_key' => ['required'],
            'status' => ['required'],

            // 'questions[]' => ['required'],
            'questions.*.name' => ['required'],
            'questions.*.answer' => ['required'],
            // 'questions.*.sort' => ['nullable'],

            // 'create_date',
            // 'update_date',
            // 'user_id',
            // 'faq_id',
            // 'file_id',
            // 'sort',
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->filled('url')) {
            $this->merge([
                'url' => Str::slug($this->input('name')),
            ]);
        }
    }
}

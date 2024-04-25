<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'min:0'],
            'name' => ['required'],
            'answer' => ['required'],
            'sort' => ['required', 'integer', 'min:0'],
            'faq_id' => ['required', 'integer', 'min:0'],
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->filled('sort')) {
            $this->merge([
                'sort' => 0,
            ]);
        }
    }
}
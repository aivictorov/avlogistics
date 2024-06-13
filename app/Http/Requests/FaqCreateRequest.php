<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class FaqCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'h1' => ['required'],
            'announce' => ['nullable'],
            'url' => ['required', 'min:3'],
            'sort_key' => ['required'],
            'status' => ['required'],

            // 'questions.*.name' => ['required'],
            // 'questions.*.answer' => ['required'],
            // 'questions.*.sort' => ['required', 'integer', 'min:0'],

            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'keywords' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->filled('url')) {
            $this->merge([
                'url' => Str::slug($this->input('name')),
            ]);
        }

        if (!$this->filled('sort_key')) {
            $this->merge([
                'sort_key' => 0,
            ]);
        }
    }
}
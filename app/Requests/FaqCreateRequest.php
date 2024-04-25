<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class FaqCreateRequest extends FormRequest
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

            // 'questions.*.name' => ['required'],
            // 'questions.*.answer' => ['required'],
            // 'questions.*.sort' => ['required', 'integer', 'min:0'],

            'title' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['required', 'string', 'min:3', 'max:250'],
            'keywords' => ['required', 'string', 'min:3', 'max:250'],
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
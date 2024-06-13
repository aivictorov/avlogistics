<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class FaqEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'h1' => ['required', 'string'],
            'announce' => ['nullable', 'string'],
            'url' => ['required', 'min:3'],
            'sort_key' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],

            'questions.*.name' => ['required'],
            'questions.*.answer' => ['required'],
            'questions.*.sort' => ['required', 'integer', 'min:0'],

            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'keywords' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        $questons = [];

        foreach ($this->input('questions.*') as $question) {
            array_push($questons, $question);
        }

        foreach ($questons as &$item) {
            if (!$item['sort']) {
                $item['sort'] = 1;
            }
        }

        $this->merge([
            'questions' => $questons,
        ]);

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
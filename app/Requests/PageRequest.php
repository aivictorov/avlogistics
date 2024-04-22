<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'h1' => ['required', 'string', 'min:3', 'max:100'],
            'parent_id' => ['required', 'integer', 'min:0'],
            'text' => ['required', 'string', 'min:20'],
            'url' => ['required', 'min:3', 'max:50'],
            'menu_sort' => ['required', 'integer', 'min:0', 'max:100'],
            'menu_show' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
            // 'system_page' => ['required', 'in:0,1,2,3,4,5,6,7'],

            'title' => ['nullable', 'string', 'min:3', 'max:100'],
            'description' => ['nullable', 'string', 'min:3', 'max:500'],
            'keywords' => ['nullable', 'string', 'min:3', 'max:500'],

            'avatar' => ['nullable', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=270',],
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
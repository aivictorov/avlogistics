<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'h1' => ['required', 'string', 'min:3', 'max:100'],
            'parent_id' => ['required', 'integer', 'min:0'],
            'text' => ['nullable', 'string', 'min:12'],
            'url' => ['required', 'min:3', 'max:100'],
            'menu_sort' => ['required', 'integer', 'min:0', 'max:100'],
            'menu_show' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],

            'title' => ['required', 'string', 'min:3', 'max:200'],
            'description' => ['required', 'string', 'min:3', 'max:500'],
            'keywords' => ['required', 'string', 'min:3', 'max:500'],

            'avatar' => ['nullable', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=270',],
        ];
    }

    protected function prepareForValidation()
    {
        $this['text'] = str_replace('<script src="//cdn.public.flmngr.com/FLMNFLMN/widgets.js"></script>', '', $this['text']);

        if (!$this->filled('url')) {
            $this->merge([
                'url' => Str::slug($this->input('name')),
            ]);
        }

        if (!$this->filled('menu_sort')) {
            $this->merge([
                'menu_sort' => 0,
            ]);
        }

        if (!$this->filled('menu_show')) {
            $this->merge([
                'menu_show' => 1,
            ]);
        }

        if (!$this->filled('status')) {
            $this->merge([
                'status' => 1,
            ]);
        }
    }
}
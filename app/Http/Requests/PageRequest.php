<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'h1' => ['required', 'string'],
            'parent_id' => ['required', 'integer', 'min:0'],
            'text' => ['nullable', 'string'],
            'url' => ['required', 'min:3'],
            'menu_sort' => ['required', 'integer', 'min:0'],
            'menu_show' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],

            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'keywords' => ['required', 'string'],

            'avatar' => ['nullable', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=270'],
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
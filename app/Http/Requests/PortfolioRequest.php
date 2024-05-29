<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PortfolioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'h1' => ['required', 'string', 'min:3', 'max:100'],
            'portfolio_section_id' => ['required', 'integer', 'min:0'],
            'text' => ['required', 'string', 'min:12'],
            'url' => ['required', 'min:3', 'max:50'],
            'sort_key' => ['required', 'integer', 'min:0', 'max:100'],
            'status' => ['required', 'boolean'],

            'title' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['required', 'string', 'min:3', 'max:250'],
            'keywords' => ['required', 'string', 'min:3', 'max:250'],

            'avatar' => ['sometimes', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=270',],
            'images.*' => ['sometimes', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=350',],
            'edit_images.*.sort' => ['sometimes', 'integer'],
            'edit_images.*.del' => ['sometimes'],
        ];
    }

    protected function prepareForValidation()
    {
        $this['text'] = str_replace('<script src="//cdn.public.flmngr.com/FLMNFLMN/widgets.js"></script>', '', $this['text']);
        // $this['text'] = strip_tags($this['text']);

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
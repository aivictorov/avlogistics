<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'page_id' => ['required', 'integer'],
            'status' => ['required', 'boolean'],
            'images.*' => ['sometimes', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=350',],
            'items.*.text' => ['nullable', 'string'],
            'items.*.sort' => ['nullable', 'integer', 'min:0'],
            'items.*.portfolio_id' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function prepareForValidation()
    {
        // 
    }
}
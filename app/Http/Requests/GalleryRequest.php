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

            'items.*.text' => ['sometimes', 'string'],
            'items.*.sort' => ['sometimes', 'integer'],

            'images.*' => ['sometimes', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=350',],

            // 'edit_images.*.text' => ['sometimes', 'string'],
            // 'edit_images.*.sort' => ['sometimes', 'integer'],
            // 'edit_images.*.del' => ['sometimes'],
            // 'images.*.answer' => ['required'],
            // 'images.*.sort' => ['required', 'integer', 'min:0'],
        ];
    }

    protected function prepareForValidation()
    {
        // 
    }
}
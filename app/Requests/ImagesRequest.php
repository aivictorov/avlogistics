<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImagesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'page_id' => ['required', 'integer'],
            'page_type' => ['required', 'string'],
            'images.*' => ['required', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=350',],
        ];
    }
}
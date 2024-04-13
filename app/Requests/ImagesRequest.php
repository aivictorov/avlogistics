<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ImagesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'images.*' => ['sometimes', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=350',],
        ];
    }
}
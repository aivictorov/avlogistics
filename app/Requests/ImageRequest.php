<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => ['sometimes', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=350',],
        ];
    }
}
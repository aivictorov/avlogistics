<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
    public function rules()
    {
        return [
            'page_id' => ['required', 'integer'],
            'page_type' => ['required', 'string'],
            'avatar_file' => ['required', 'mimes:jpg,jpeg', 'dimensions:min_width=670,min_height=270',],
        ];
    }
}
<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules()
    {
        return [
            'string' => ['required', 'string'],
        ];
    }
}
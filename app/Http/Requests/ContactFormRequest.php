<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'string'],
            'message' => ['sometimes', 'string'],
            'g-recaptcha-response' => ['sometimes', 'string'],
        ];
    }
}
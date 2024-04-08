<?php

namespace App\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            // 'name' => ['required', 'string', 'max:64'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:6', 'max:16', 'confirmed'],
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ];
    }
}

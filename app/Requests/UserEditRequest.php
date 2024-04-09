<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required'],
            'current_password' => ['current_password'],
            'password' => ['confirmed'],
        ];
    }
}
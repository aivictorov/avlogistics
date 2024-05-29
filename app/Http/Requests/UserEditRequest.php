<?php

namespace App\Http\Requests;

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
            'role' => ['required'],
            'status' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->filled('role')) {
            $this->merge([
                'role' => 'admin',
            ]);
        }

        if (!$this->filled('status')) {
            $this->merge([
                'status' => 1,
            ]);
        }
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'confirmed'],
            'role' => ['required', 'string'],
            'status' => ['required', 'boolean'],
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
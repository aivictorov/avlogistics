<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'confirmed'],
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
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => ['nullable', 'string'],
            'text' => ['nullable', 'string'],
            'sort' => ['nullable', 'integer', 'min:0'],
            'portfolio_id' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function prepareForValidation()
    {
        if (!$this->filled('sort')) {
            $this->merge([
                'sort' => 0,
            ]);
        }
    }
}
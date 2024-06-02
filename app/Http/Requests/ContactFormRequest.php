<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'company' => ['nullable', 'string'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string'],
            'from' => ['nullable', 'string'],
            'to' => ['nullable', 'string'],
            'message' => ['required', 'string', 'min:5'],
            'files.*' => [
                'nullable',
                'mimes:pdf,jpeg,jpg,png,docx,doc,xlsx,xls',
                'mimetypes:application/pdf,image/jpeg,image/png,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel',
                'min:1',
                'max:5120'
            ],
            'g-recaptcha-response' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        function my_trim($var)
        {
            $var = strip_tags($var);
            return $var;
        }

        $this['company'] = my_trim($this['company']);
        $this['name'] = my_trim($this['name']);
        $this['phone'] = my_trim($this['phone']);
        $this['email'] = my_trim($this['email']);
        $this['from'] = my_trim($this['from']);
        $this['to'] = my_trim($this['to']);
        $this['message'] = my_trim($this['message']);
    }
}
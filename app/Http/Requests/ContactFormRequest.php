<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'company' => ['required', 'string'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'from' => ['sometimes', 'string'],
            'to' => ['sometimes', 'string'],
            'message' => ['required', 'string', 'min:5'],
            'g-recaptcha-response' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        function my_trim($var)
        {
            $var = trim($var);
            $var = htmlspecialchars($var);
            $var = stripcslashes($var);
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
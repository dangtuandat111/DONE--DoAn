<?php

namespace Packages\Server\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public $errorMessage = 'Message Error: ';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'max: 250',
                'regex:/^([a-z0-9.\/\+%&,|}#\"_~:-]+)\@([a-z0-9_])([a-z0-9._-]*)\.([a-z]+$)/ix'
            ],
            'password' => [
                'required',
                'max: 8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$|^([0-9]{8})+$/'
            ]
        ];
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => $this->errorMessage . 'Email is required',
            'password.required' => $this->errorMessage . 'Password is required',
            'email.max', 'email.regex' => $this->errorMessage . 'Email addrsess is invalid',
            'password.max', 'password.regex' => $this->errorMessage . 'Password is invalid'
        ];
    }
}

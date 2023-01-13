<?php

namespace Packages\Client\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SignupRequest extends FormRequest
{
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
                'unique:customer,email',
                'regex:/^([a-z0-9.\/\+%&,|}#\"_~:-]+)\@([a-z0-9_])([a-z0-9._-]*)\.([a-z]+$)/ix'
            ],
            'password' => [
                'required',
                'max: 250',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$|^([0-9]{8})+$/'
            ],
            'name' => [
                'required',
                'max: 250'
            ]

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return $validator;
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'name.required' => 'User name is required',
            'email.max', 'email.unique', 'email.regex' => 'Email address is not valid',
            'password.max', 'password.regex' => 'Password is not valid',
        ];
    }
}

<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class EditAccountRequest extends FormRequest
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
            'username' => [
                'required_without_all:email,password',
                'nullable',
                'unique:users',
                'alpha',
                'min:4',
                'max:16'
            ],
            'email' => [
                'required_without_all:username,password',
                'nullable',
                'unique:users',
                'email'
            ],
            'password' => [
                'required_without_all:username,email',
                'nullable',
                'confirmed',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
            ]
        ];
    }
}

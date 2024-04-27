<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {

        $id = $request->route('user');
        return [
            'username' => [
                'required',
                'unique:users,username,' . $id,
                'alpha_dash',
                'min:3',
                'max:20',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $id,
            ],
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$%\^&\*])/u', // must contain Uppercase, 0-9, special character
                'confirmed',
            ],
            'password_confirmation' => [
                'required',
            ],
            'phone' => [
                'required',
                'digits:10',
                'unique:users,phone,' . $id,
            ],
            'address' => [
                'required',
                'max:255',
            ],
            'roles' => [
                'required',
            ]
        ];
    }
    public function messages()
    {
        return [
            '*.required' => 'This field is required!',
        ];
    }
}

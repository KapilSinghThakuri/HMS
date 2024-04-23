<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoginCredentialRequest extends FormRequest
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
        return [
            'token' => ['required'],
            'email' => ['required','email','exists:users,email'],
            'password' => [
                    'required',
                    'string',
                    'min:6',
                    // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                    // function ($attribute, $value, $fails) use($request)
                    // {
                    //     $username = $request->input('username');
                    //     $email = $request->input('email');
                    //     if (stripos($value, $username) !== false ||
                    //         stripos($value, $email) !== false ) {
                    //         $fail('The password cannot contain your username, email address.');
                    //     }
                    // }
                ],
            'password_confirmation' => ['required'],
        ];
    }
}

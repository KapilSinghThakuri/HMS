<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthenticationRequest extends FormRequest
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
            'username' => 'required|string|min:3|max:40|alpha_dash',
            'password' => [
                    'required',
                    'string',
                    'min:6',
                    // Requires at least one uppercase letter, one lowercase letter, one number, and one special character
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                    // Using Closure Method for checking if password contain user information like username, email
                    function ($attribute, $value, $fails) use($request)
                    {
                        $username = $request->input('username');
                        $email = $request->input('email');
                        // stripos(string $haystack, string $needle) methods finds the position of the first occurrence of a case-insensitive substring within a string
                        if (stripos($value, $username) !== false ||
                            stripos($value, $email) !== false ) {
                            $fail('The password cannot contain your username, email address.');
                        }
                    }
                ]
        ];
    }
}

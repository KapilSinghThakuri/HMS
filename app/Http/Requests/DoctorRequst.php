<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class DoctorRequst extends FormRequest
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
            'first_name' => ['required', 'alpha'],
            'middle_name' => ['nullable', 'alpha'],
            'last_name' => ['required', 'alpha'],
            'phone' => ['required', 'numeric', 'digits:10'],
            'department_id' => ['required'],
            'license_no' => ['required','alpha_dash'],
            'profile' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:3072'],

            'dobBS' => ['required', 'date'],
            'dobAD' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'country' => ['required', 'string'],
            'district' => ['required', 'string'],
            'municipality' => ['required','string'],
            'province' => ['required', 'string'],
            'street' => ['nullable', 'string'],
            'institute_name' => ['required', 'string', 'max:255'],
            'medical_degree' => ['required', 'string', 'max:255'],
            'grad_yearBS' => ['required', 'date'],
            'grad_yearAD' => ['required', 'date'],
            'specialization' => ['required', 'string', 'max:255'],
            'org_name' => ['required', 'string', 'max:255'],
            'start_dateBS' => ['required', 'date'],
            'start_dateAD' => ['required', 'date'],
            'end_dateBS' => ['required', 'date'],
            'end_dateAD' => ['required', 'date'],
            'jobDescription' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                    'required',
                    'string',
                    'min:6',
                    'confirmed',
                    // Requires at least one uppercase letter, one lowercase letter, one number, and one special character
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]+$/',
                    // Using Closure Method for checking if password contain user information like username, email
                    function ($attribute, $value, $fails) use ($request)
                    {
                        $first_name = $request->input('first_name');
                        $middle_name = $request->input('middle_name');
                        $last_name = $request->input('last_name');
                        $email = $request->input('email');
                        // stripos(string $haystack, string $needle) methods finds the position of the first occurrence of a case-insensitive substring within a string
                        if (stripos($value, $first_name) !== false ||
                            stripos($value, $middle_name) !== false ||
                            stripos($value, $last_name) !== false ||
                            stripos($value, $email) !== false ) {
                            $fails('The password cannot contain your username, email address.');
                        }
                    }
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

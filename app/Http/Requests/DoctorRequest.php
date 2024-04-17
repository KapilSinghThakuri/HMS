<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
        $rules = [
            'first_name' => ['required', 'alpha'],
            'middle_name' => ['nullable', 'alpha'],
            'last_name' => ['required', 'alpha'],
            'gender' => ['required', 'string'],
            'date_of_birth_BS' => ['required', 'date'],
            'date_of_birth_AD' => ['required', 'date'],
            'phone' => ['required', 'numeric', 'digits:10'],
            'license_no' => ['required','alpha_dash'],
            'department_id' => ['required'],
            'profile' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:3072'],

            'country_id' => ['required', 'string'],
            'province_id' => ['required', 'string'],
            'district_id' => ['required', 'string'],
            'municipality_id' => ['required','string'],
            'street' => ['nullable', 'string'],

            'temp_country_id' => ['nullable', 'string', 'max:255'],
            'temp_province_id' => ['nullable', 'string', 'max:255'],
            'temp_district_id' => ['nullable', 'string', 'max:255'],
            'temp_municipality_id' => ['nullable', 'string', 'max:255'],
            'temp_street' => ['nullable', 'string', 'max:255'],

            'institute_name.*' => ['required', 'string', 'max:255'],
            'medical_degree.*' => ['required', 'string', 'max:255'],
            'graduation_year_BS.*' => ['required', 'date'],
            'graduation_year_AD.*' => ['required', 'date'],
            'specialization.*' => ['required', 'string', 'max:255'],

            'org_name.*' => ['required', 'string', 'max:255'],
            'start_date_BS.*' => ['required', 'date'],
            'start_date_AD.*' => ['required', 'date'],
            'end_date_BS.*' => ['required', 'date'],
            'end_date_AD.*' => ['required', 'date'],
            'job_description.*' => ['required', 'string'],

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
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = ['nullable', 'email'];
            $rules['password'] = ['nullable','min:6','confirmed',];
        }

        return $rules;
    }
    // public function messages()
    // {
    //     return [
    //         '*.required' => 'This field is required!',
    //     ];
    // }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
        $id = Auth::user()->id;
    return [
            'first_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'in:Male,Female,Other'],
            'email' => 'nullable|email|unique:users,email,' . $id,
            'profile' => ['nullable','image','mimes:jpeg,png,jpg,gif','max:3072'],
            'date_of_birth_BS' => ['nullable', 'date'],
            'date_of_birth_AD' => ['nullable', 'date'],
            'phone' => ['nullable', 'numeric', 'digits:10'],
            'department_id' => ['nullable', 'integer'],

            'country' => ['nullable', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'municipality' => ['nullable', 'string', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],

            'country_tempName' => ['nullable', 'string', 'max:255'],
            'province_tempName' => ['nullable', 'string', 'max:255'],
            'district_tempName' => ['nullable', 'string', 'max:255'],
            'municipality_tempName' => ['nullable', 'string', 'max:255'],
            'street_tempName' => ['nullable', 'string', 'max:255'],

            'institute_name' => ['nullable', 'string', 'max:255'],
            'medical_degree'=> ['nullable', 'string', 'max:255'],
            'graduation_year_BS' => ['nullable', 'date'],
            'graduation_year_AD'=> ['nullable', 'date'],
            'specialization' => ['nullable', 'string', 'max:255'],

            'license_no' => ['nullable', 'numeric', 'digits:6'],
            'org_name' => ['nullable', 'string', 'max:255'],
            'start_date_BS' => ['nullable', 'date'],
            'start_date_AD' => ['nullable', 'date'],
            'end_date_BS' => ['nullable', 'date'],
            'end_date_AD' => ['nullable', 'date'],
            'job_description'=> ['nullable', 'string', 'max:255'],
        ];
    }

    // Add validation rules for degree-related fields
    public static function degreeRules()
    {
        $rules = [];
        for ($i = 0; $i < 3; $i++) {
            $rules["institute_name$i"] = ['nullable', 'string', 'max:255'];
            $rules["medical_degree$i"] = ['nullable', 'string', 'max:255'];
            $rules["graduation_year_BS$i"] = ['nullable', 'date'];
            $rules["graduation_year_AD$i"] = ['nullable', 'date'];
            $rules["specialization$i"] = ['nullable', 'string', 'max:255'];
        }
        return $rules;
    }

    // Add validation rules for job-related fields
    public static function experienceRules()
    {
        $rules = [];
        for ($i = 0; $i < 3; $i++) {
            $rules["org_name$i"] = ['nullable', 'string', 'max:255'];
            $rules["start_date_BS$i"] = ['nullable', 'date'];
            $rules["start_date_AD$i"] = ['nullable', 'date'];
            $rules["end_date_BS$i"] = ['nullable', 'date'];
            $rules["end_date_AD$i"] = ['nullable', 'date'];
            $rules["job_description$i"] = ['nullable', 'string', 'max:255'];
        }
        return $rules;
    }
}


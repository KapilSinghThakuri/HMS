<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'department_code' => 'required|alpha_dash|unique:departments,department_code',
            'department_name' => 'required|string',
            'department_desc' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            '*.required' => 'This field is required.',
        ];
    }
}

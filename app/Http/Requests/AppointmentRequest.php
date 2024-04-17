<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'doctor_id' => 'required',
            'fullname' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'phone' => 'required|numeric|digits:10',
            'email' => 'required|email|max:255',
            'parents_name' => 'nullable|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'temporary_address' => 'nullable|string|max:255',
            'medical_history' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'reason' => 'required|string',
            'appointment_message' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            '*.required' => 'This field is required!',
        ];
    }
}

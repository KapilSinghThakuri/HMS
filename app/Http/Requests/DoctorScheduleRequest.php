<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorScheduleRequest extends FormRequest
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
            'doctor_id' => ['required'],
            'in' => ['required','date_format:Y-m-d'],
            'from' => ['required', 'date_format:H:i'],
            'to' => ['required', 'date_format:H:i'],
        ];
    }
    public function messages()
    {
        return [
            '*.required' => 'This field is required!',
            'in.date_format' => 'Please enter a valid date in YYYY-MM-DD format.',
            'from.date_format' => 'Please enter a valid time in HH:MM format.',
            'to.date_format' => 'Please enter a valid time in HH:MM format.'
        ];
    }
}

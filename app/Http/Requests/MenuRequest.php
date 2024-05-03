<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'display_order' =>  'required|numeric',
            'menu_type_id' => 'required',
            'model_id' => 'nullable',
            'page_id' => 'nullable',
            'external_link' => 'nullable',

            'menu_name.np' => 'required',
            'menu_name.en' => 'required',

            'status' => 'required',
            'parent_id' => 'nullable',
        ];
    }
}

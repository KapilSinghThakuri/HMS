<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'gallery_category_id' => 'required',
            'file_type' => 'required',
            'display_order' => 'required|min:1|numeric',
            'file' => 'required|required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:2048',
            'file_type' =>'required',
            'status' => 'required'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectEditRequest extends FormRequest
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
            'title_ar'=> 'required',
            'title_en'=> 'required',
            'slug'=> 'required',
            'body_ar'=> 'required',
            'body_en'=> 'required',
            'meta_title_ar'=> 'required',
            'meta_title_en'=> 'required',
            'meta_description_ar'=> 'required',
            'meta_description_en'=> 'required',
        ];
    }
}

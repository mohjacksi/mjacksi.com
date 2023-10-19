<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'photo_id'=> 'required',
            'title_ar'=> 'required',
            'project_category_id_en'=> 'required',
            'project_category_id_ar'=> 'required',
            'title_en'=> 'required',
            'slug'=> 'required',
            'slug'=> 'unique:projects,slug,{$projectId}|required',
            'body_ar'=> 'required',
            'body_en'=> 'required',
            'meta_title'=> 'required',
            'meta_description'=> 'required',
        ];
    }
}

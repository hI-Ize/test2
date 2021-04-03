<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

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
            'name' => 'required|min:1|max:50',
            'description' => 'required|min:1|max:500',
            'status' => 'required|in:0,1,2',
            'contact_name' => 'sometimes|required|min:1|max:50',
            'contact_name.*' => 'sometimes|required|min:1|max:50',
            //'contact_email.*' => 'sometimes|required|email|unique:contact_persons,email'
            'contact_email.*' => 'sometimes|required|email'
            //
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        $id = $this->route('id');

        $rules = [
            'name' => 'required|max:255',
            'major_id' => 'required',
            'phone' => [
                'required', 
                'max:15', 
                'min:7', 
                'unique:students,phone' . ($id ? ',' . $id : ''),
                'regex:/^(\+\d+|\d+)$/'
            ],
            'email' => 'required|max:255|unique:students,email' . ($id ? ',' . $id : ''),
            'address' => 'required|max:255',
        ];

        return $rules;
    }
}

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
        $rules = [
            'name' => 'required',
            'major_id' => 'required',
            'phone' => ['required', 'unique:students,phone', 'regex:/^(\+\d+|\d+)$/'],
            'email' => 'required|unique:students,email',
            'address' => 'required',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('id');
            $rules['phone'] = 'required|unique:students,phone,' . $id;
            $rules['email'] = 'required|unique:students,email,' . $id;
        }

        return $rules;
    }
}

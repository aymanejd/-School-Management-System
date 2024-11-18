<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentsRequest extends FormRequest
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
            'Name' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6|max:10',
            'gender' => 'required',
            'nationalitie_id' => 'required',
            'Date_Birth' => 'required|date|date_format:Y-m-d',
            'grade_id' => 'required',
            'phase_id' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required',
            'academic_year' => 'required',
        ];
    }
}
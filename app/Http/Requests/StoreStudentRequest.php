<?php

namespace busRegistration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'current_school_id' => 'required|exists:schools,id',
            'next_school_id'  => 'required|exists:schools,id',
            'grade_id'  => 'required|exists:grades,id',
        ];
    }
}

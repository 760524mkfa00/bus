<?php

namespace busRegistration\Http\Requests;

use busRegistration\Rules\YesNo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'current_school_id' => 'required|exists:schools,id',
            'next_school_id'  => 'required|exists:schools,id',
            'grade_id'  => 'required|exists:grades,id',
            'international' => ['required', new YesNo],
            'paid' => ['required', new YesNo],
            'seat_assigned' => ['required', new YesNo],
            'processed' => ['required', new YesNo]
        ];

    }
}

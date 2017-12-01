<?php

namespace busRegistration\Http\Requests;

use Illuminate\Validation\Rule;
use busRegistration\Rules\YesNo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => ['required','email','max:255', Rule::unique('users')->ignore(request()->user->id)],
            'role' => 'required|exists:roles,id', // validating role
            "active" => ['required', new YesNo]
        ];
    }
}

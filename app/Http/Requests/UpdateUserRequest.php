<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'phone_number' => ['required'],
            'email' => ['required', 'string', 'max:191', 'unique:users'],
        ];

        if ($this->input('rol') === 'student') {
            $rules['career'] =  ['required'];
        }

        if ($this->input('rol') === 'teacher') {
            $rules['subjects_taught'] = ['required', 'string', 'max:191'];
        }

        return $rules;
    }
}

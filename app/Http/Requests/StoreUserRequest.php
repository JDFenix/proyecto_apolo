<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {

        $rules = [
            'rol' => ['required'],
            'name' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'paternal_surname' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'maternal_surname' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'string', 'max:191', 'unique:users'],
            'date_birthday' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:-110 years', 'after_or_equal:-110 years','before:18 years ago'],
            'sex' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'phone_number' => ['required'],
            'password' => ['required', 'string', 'min:8']

        ];

        if ($this->input('rol') === 'student') {
            $rules['career'] =  ['required'];
        }

        if ($this->input('rol') === 'teacher') {
            $rules['license'] = ['required', 'string', 'max:191'];
            $rules['professional_title'] = ['required', 'string', 'max:191'];
            $rules['subjects_taught'] = ['required', 'string', 'max:191'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras.',

            'paternal_surname.required' => 'El apellido paterno es obligatorio.',
            'paternal_surname.regex' => 'El apellido paterno solo puede contener letras.',

            'maternal_surname.required' => 'El apellido materno es obligatorio.',
            'maternal_surname.regex' => 'El apellido materno solo puede contener letras.',

            'date_birthday.required' => 'El campo fecha de nacimiento es obligatorio.',
            'date_birthday.before_or_equal' => 'La fecha de nacimiento no puede ser en el futuro.',
            'date_birthday.after_or_equal' => 'Debes tener al menos 110 años.',
            'date_birthday.before' => 'Debes ser mayor a 18 años',

            'sex.required' => 'El género es obligatorio.',

            'email.required' => 'El campo email es obligatorio.',
            'email.unique' => 'El email ya está en uso.',

            'phone_number.required' => 'El número de teléfono es obligatorio.',
            // 'phone_number.digits' => 'El número de teléfono debe tener exactamente 10 dígitos.',

            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}

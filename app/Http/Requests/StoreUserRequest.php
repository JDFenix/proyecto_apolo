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
        return [
            'name' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'paternal_surname' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'maternal_surname' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],            
            'email' => 'required|string|max:191|unique:users',
            'password' => ['required', 'string', 'min:8',]
        ];
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




            
            'email.required' => 'El campo email es obligatorio.',
            'email.unique' => 'El email ya está en uso.',

            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
           
        ];
    }
    
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvisoryRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'tittle' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'subject' => ['required', 'string', 'max:191'],
            'status' => ['required', 'string', 'max:191'],
            'date' => ['required'],
            'time' => ['required'],
            'teachers_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'tittle.required' => 'El tema es obligatorio.',

            'subject.required' => 'La materia es obligatorio.',

            'date.required' => 'La fecha de la asesoria es obligatoria',

            'time.required' => 'La hora de la asesoria es obligatoria.',
        ];
    }
}

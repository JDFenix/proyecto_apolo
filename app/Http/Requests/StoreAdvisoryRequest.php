<?php

namespace App\Http\Requests;

use App\Models\Advisory;
use Illuminate\Contracts\Validation\Rule;
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
     * @return array
     */
    public function rules(): array
    {
        $user = $this->user();
        $existingAdvisories = Advisory::where('teachers_id', $user->id)->get();
    
        $rules = [
            'tittle' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'subject' => ['required', 'string', 'max:191'],
            'status' => ['required', 'string', 'max:191'],
            'time' => [
                'required', 
                'date_format:H:i', 
                'after_or_equal:08:00', 
                'before_or_equal:18:00', 
                function ($attribute, $value, $fail) use ($user, $existingAdvisories) {
                    $now = \Carbon\Carbon::now('America/Mexico_City');
                    $time = \Carbon\Carbon::createFromFormat('H:i', $value, 'America/Mexico_City');
                    if ($time->lt($now)) {
                        $fail('No puedes programar una asesoría en el pasado.');
                    }
                    if (\Carbon\Carbon::parse($value)->diffInMinutes($now) < 30) {
                        $fail('Debes programar la asesoría con al menos 30 minutos de anticipación.');
                    }
                    foreach ($existingAdvisories as $advisory) {
                        if (\Carbon\Carbon::parse($value)->diffInMinutes(\Carbon\Carbon::parse($advisory->time)) < 60) {
                            $fail('Debe haber al menos una hora entre el inicio de cada asesoría.');
                        }
                    }
                },
            ],
            
            
            
            
            
            
            
            
            
            'time' => [
                'required', 
                'date_format:H:i', 
                'after_or_equal:08:00', 
                'before_or_equal:18:00', 
                function ($attribute, $value, $fail) use ($user, $existingAdvisories) {
                    if (\Carbon\Carbon::parse($value)->diffInMinutes(\Carbon\Carbon::now()) < 30) {
                        $fail('Debes programar la asesoría con al menos 30 minutos de anticipación.');
                    }
                    foreach ($existingAdvisories as $advisory) {
                        if (\Carbon\Carbon::parse($value)->diffInMinutes(\Carbon\Carbon::parse($advisory->time)) < 60) {
                            $fail('Debe haber al menos una hora entre el inicio de cada asesoría.');
                        }
                    }
                },
            ],
        ];
    
        return $rules;
    }
    
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'tittle.required' => 'El tema es obligatorio.',
            'subject.required' => 'La materia es obligatoria.',
            'date.required' => 'La fecha de la asesoría es obligatoria.',
            'time.required' => 'La hora de la asesoría es obligatoria.',

            'date.after_or_equal' => 'La fecha de la asesoría debe ser igual o posterior a la fecha actual.',
            'date.before_or_equal' => 'La fecha de la asesoría debe ser como máximo dentro de un mes.',
            'date.no_past_date' => 'No puedes programar una asesoría en el pasado.',
            'date.no_overlap_date' => 'No puedes programar una asesoría que se superponga con otra existente.',
            'time.after_or_equal' => 'La hora de la asesoría debe ser como mínimo a las 8:00 AM.',
            'time.before_or_equal' => 'La hora de la asesoría debe ser como máximo a las 6:00 PM.',
            'time.date_difference' => 'Debes programar la asesoría con al menos 30 minutos de anticipación.',
            'time.time_difference' => 'Debe haber al menos una hora entre el inicio de cada asesoría.',
        ];
    }

}

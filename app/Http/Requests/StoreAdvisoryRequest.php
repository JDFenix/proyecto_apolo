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
    
        return [
            'teachers_id' => ['required'],
            'tittle' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
            'subject' => ['required', 'string', 'max:191'],
            'status' => ['required', 'string', 'max:191'],
            'time' => [
                'required',
                'after_or_equal:08:00',
                'before_or_equal:18:00',
                function ($attribute, $value, $fail) use ($user, $existingAdvisories) {
                    $now = \Carbon\Carbon::now('America/Mexico_City');
                    $time = \Carbon\Carbon::createFromFormat('H:i', $value, 'America/Mexico_City');
                   
                    if (\Carbon\Carbon::parse($value)->diffInMinutes($now) < 30) {
                        $fail('Debes programar la asesoría con al menos 30 minutos de anticipación');
                    }
                    foreach ($existingAdvisories as $advisory) {
                        if (\Carbon\Carbon::parse($value)->diffInMinutes(\Carbon\Carbon::parse($advisory->time)) < 60) {
                            $fail('Debe haber al menos una hora entre el inicio de cada asesoría.');
                        }
                    }
                },
            ],
    
            'date' => [
                'required',
                'after:today',
               
                function ($attribute, $value, $fail) use ($user, $existingAdvisories) {
                    if (\Carbon\Carbon::parse($value)->diffInMinutes(\Carbon\Carbon::now()) < 30) {
                        $fail('time.date_difference');
                    }
                    foreach ($existingAdvisories as $advisory) {
                        if (\Carbon\Carbon::parse($value)->diffInMinutes(\Carbon\Carbon::parse($advisory->time)) < 60) {
                            $fail('time.time_difference');
                        }
                    }
                },
            ],
            
        ];
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
        'status.required' => 'El estado es obligatorio.',
        'time.required' => 'La hora de la asesoría es obligatoria.',

        'time.after_or_equal' => 'La hora de la asesoría debe ser como mínimo a las 8:00 AM.',
        'time.before_or_equal' => 'La hora de la asesoría debe ser como máximo a las 6:00 PM.',

       

        'time.after' => 'No puedes programar una asesoría para el pasado.',
        'time.before' => 'No puedes programar una asesoría para hoy o días anteriores.',

        'time.between' => 'La hora de la asesoría debe estar entre las 8:00 AM y las 6:00 PM.',
        'date.after' => 'La fecha de la asesoría debe ser posterior a la fecha actual.',

        'time.date_difference' => 'Debes programar la asesoría con al menos 30 minutos de anticipación.',
        'time.time_difference' => 'Debe haber al menos una hora entre el inicio de cada asesoría.',
    ];
}

}

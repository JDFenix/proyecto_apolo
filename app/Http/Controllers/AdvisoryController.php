<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvisoryRequest;
use App\Models\Advisory;
use App\Models\User;
use App\Models\User_advisories;
use App\Models\User_Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class AdvisoryController extends Controller
{


    public function subscribeAdvisory(Request $request, int $studentId, int $advisoryId)
    {
        $token = $request->input('subscribe_token');

        if ($token != Session::get('subscribe_token')) {
            return $this->index();
        }
        $user = Auth::user();
        $userRol = $user->rol;

        if ($userRol == 'student') {
            $userAdvisory = User_advisories::where('student_id', $studentId)->where('advisory_id', $advisoryId)->first();

            if ($userAdvisory) {
                $userAdvisory->delete();
            } else {
                User_advisories::create([
                    'student_id' => $studentId,
                    'advisory_id' => $advisoryId
                ]);
            }
        }
        return redirect()->route('home');
    }



    public function index()
    {
        $user = Auth::user();
        $userRol = $user->rol;
        $user_id = $user->id;

        if ($userRol == 'teacher') {
            $advisories = Advisory::where('teachers_id', $user_id)->get();
        } elseif ($userRol == 'student') {
            $userTeacherRecords = User_Teacher::where('users_id', $user_id)->get();
            $advisories = collect();

            foreach ($userTeacherRecords as $record) {
                $teacherId = $record->teachers_id;
                $advisories = $advisories->merge(Advisory::where('teachers_id', $teacherId)->get());
            }

            $advisories = $advisories->map(function ($advisory) use ($user_id) {
                $isSubscribed = User_advisories::where('student_id', $user_id)->where('advisory_id', $advisory->id)->exists();
                $advisory->isSubscribed = $isSubscribed;
                return $advisory;
            });
        } else {
            $advisories = collect();
        }

        return view('user.index', ['advisories' => $advisories]);
    }


    public function store(StoreAdvisoryRequest $request)
    {

        $advisory = $request->validated();
        $advisorycreated = Advisory::create($advisory);


        return redirect()->route('home');
    }


    public function edit(int $advisoryId)
    {
        $advisory = Advisory::findOrFail($advisoryId);
        $studentsAdvisory = User_advisories::where('advisory_id', $advisoryId)->get();
        return view('advisory.modify')->with([
            'advisory' => $advisory,
            'studentsAdvisory' => $studentsAdvisory
        ]);
    }
    public function destroy(int $id)
    {
        try {
            $advisory = Advisory::findOrFail($id);
    
            $studentsAdvisory = User_advisories::where('teachers_id', $id)->get();
    
            foreach ($studentsAdvisory as $studentAdvisory) {
                $studentAdvisory->delete();
            }
    
            $advisory->delete();
    
            return $this->index();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, int $id)
{
    try {
        $advisory = Advisory::findOrFail($id);

        $rules = [
            'tittle' => ['required', 'string', 'max:191', 'regex:/^[\pL\s\-]+$/u'],
        ];

        if ($request->time != $advisory->time || $request->date != $advisory->date) {
            $rules['time'] = [
                'required',
                'after_or_equal:08:00',
                'before_or_equal:18:00',
                function ($attribute, $value, $fail) use ($request, $id) { // Pass $id to the function
                    $now = \Carbon\Carbon::now('America/Mexico_City');
                    $format = (strlen($value) <= 5) ? 'H:i' : 'H:i:s';
                    $time = \Carbon\Carbon::createFromFormat($format, $value, 'America/Mexico_City');

                    $existingAdvisories = Advisory::where('teachers_id', auth()->user()->id)
                        ->whereDate('date', $request->input('date'))
                        ->where('id', '!=', $id) // Now $id is defined
                        ->get();

                    if (!$existingAdvisories->isEmpty()) {
                        foreach ($existingAdvisories as $advisory) {
                            if (\Carbon\Carbon::parse($value)->diffInMinutes(\Carbon\Carbon::parse($advisory->time)) < 60) {
                                $fail('Debe haber al menos una hora entre el inicio de cada asesoría.');
                            }
                        }
                    }
                },
            ];
        }

        if ($request->date != $advisory->date) {
            $rules['date'] = [
                'required',
                'after:today',
                function ($attribute, $value, $fail) {
                    if (\Carbon\Carbon::parse($value)->diffInMinutes(\Carbon\Carbon::now()) < 30) {
                        $fail('time.date_difference');
                    }
                },
            ];
        }

        $request->validate($rules);

        $advisory->update($request->only(['tittle', 'time', 'date']));

        return $this->edit($id);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


  
    
}

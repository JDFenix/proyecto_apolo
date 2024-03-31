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
}

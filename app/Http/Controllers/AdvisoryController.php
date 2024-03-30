<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvisoryRequest;
use App\Models\Advisory;
use App\Models\User;
use App\Models\User_Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;



class AdvisoryController extends Controller
{



    public function index()
    {
        $userRol = Auth::user()->rol;
        $user_id = Auth::user()->id;
    
        if ($userRol == 'teacher') {
            $advisory = Advisory::where('teachers_id', $user_id)->get();
        } elseif ($userRol == 'student') {
          
            $userTeacherRecords = User_Teacher::where('users_id', $user_id)->get();
            $advisories = collect();
            foreach ($userTeacherRecords as $record) {
                $teacherId = $record->teachers_id; 
                $advisories = $advisories->merge(Advisory::where('teachers_id', $teacherId)->get());
            }
            $advisory = $advisories;
        } else {
          
            $advisory = collect(); 
        }
        return view('user.index', ['advisory' => $advisory]);
    }
    


    public function store(StoreAdvisoryRequest $request)
    {
        $advisory = $request->validated();
        $userCreated = Advisory::create($advisory);

        return redirect()->route('home');
    }
}

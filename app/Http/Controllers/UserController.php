<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LicenseValidatorController;
use App\Models\user_advisories;
use App\Models\User_Teacher;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Models\Administrator;
use App\Models\Teachers;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\User;
use Exception;
use App\Http\Requests\StoreUserRequest;
use App\Models\Advisory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
    }

    public function store(StoreUserRequest $request)
    {


        $dataUser = $request->validated();

        $url = 'https://api.dicebear.com/7.x/miniavs/svg?seed=';
        $nameUser  = $dataUser['name'];
        $dataUser['avatar'] = $url . $nameUser . Str::random(10);

        $arrayImageCover = [
            'https://th.bing.com/th/id/OIP.73Lcgf8QZLbPKSN29gPuXQHaBe?rs=1&pid=ImgDetMain',
            'https://th.bing.com/th/id/R.9314cb243b8b47e32d15e10f4442a16d?rik=%2f4zhhe5OrlTfaA&pid=ImgRaw&r=0',
            'https://th.bing.com/th/id/OIP.hXJ4lT8pFi5hXI56W5z77wHaE8?rs=1&pid=ImgDetMain',
            'https://th.bing.com/th/id/OIP.CPU7UvkWzEDJPOm83SMmqAHaCe?rs=1&pid=ImgDetMain',
            'https://th.bing.com/th/id/OIP.uzF4QTUsVM7wXSKL-6bF6AHaCe?rs=1&pid=ImgDetMain',
            'https://i.pinimg.com/originals/aa/96/94/aa9694d4a2e2db1a5dfbabac200cc349.png'
        ];

        $dataUser['image_cover'] = $arrayImageCover[array_rand($arrayImageCover)];

        $userCreated = User::create($dataUser);

        // $verificationCode = rand(100000, 999999);
        // $request->session()->put('verification_code', $verificationCode);
        // Mail::to($dataUser['email'])->send(new VerificationMail($verificationCode, $dataUser['name']));

        $roleAction = [
            'student' => function (array $dataUser, object $userCreated) {
                $this->registerStudent($dataUser, $userCreated);
            },
            'teacher' => function (array $dataUser, object $userCreated) {
                $this->registerTeacher($dataUser, $userCreated);
            },
            'administrator' => function (array $dataUser, object $userCreated) {
                $this->registerAdmin($dataUser, $userCreated);
            },
        ];

        if (isset($roleAction[$dataUser['rol']])) {
            $action = $roleAction[$dataUser['rol']];
            $action($dataUser, $userCreated);
        }
        return redirect()->route('user.confirmRegister');
    }



    public function registerStudent(array $dataUser, object $userCreated)
    {
        $firstInitialName =  substr($dataUser['name'], 0, 1);
        $yearRegistered = $userCreated->created_at->year;
        $studentEnrollment = $userCreated->id . $yearRegistered . $firstInitialName . random_int(100, 999);



        Students::create([
            'users_id' => $userCreated->id,
            'career' => $dataUser['career'],
            'enrollment' => $studentEnrollment,

        ]);
    }

    public function registerTeacher(array $dataUser, object $userCreated)
    {
        $arrayImageCover = [
            'imagePrueba',
            'image2',
        ];

        Teachers::create([
            'users_id' => $userCreated->id,
            'license' => $dataUser['license'],
            'professional_title' => $dataUser['professional_title'],
            'subjects_taught' => $dataUser['subjects_taught']
        ]);
    }

    public function registerAdmin(array $dataUser, object $userCreated)
    {
        Administrator::create([
            'users_id' => $userCreated->id,
        ]);
    }



    public function edit(int $id)
    {
    }

    public function update(Request $request, int $id)
    {
        // dd($request);
        try {
            $user = User::findOrFail($id);

            // Actualizar email y mobile_phone
            $user->update([
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            if ($user->rol == 'teacher') {
                $teacher = Teachers::where('users_id', $user->id)->first();
                $teacher->update(['subjects_taught' => $request->subjects_taught]);
            }

            return $this->showPerfil($user->id);
        } catch (Exception $e) {
            return response()->json(['error' => $e]);
        }
    }


    public function showPerfil($id)
    {


        if (Auth::user()->rol == 'teacher') {
            $teacher = Teachers::where('users_id', $id)->first();
            $advisories = $teacher->advisories()->orderBy('date', 'asc')->take(4)->get();
            return view('user.perfil', ['advisories' => $advisories]);
        } elseif (Auth::user()->rol == 'student') {
          
            $userAdvisories = User_advisories::where('student_id', $id)->get();
            
          
            $advisoryIds = [];
        
          
            foreach ($userAdvisories as $userAdvisory) {
                $advisoryIds[] = $userAdvisory->advisory_id;
            }
        
        
            $advisories = Advisory::whereIn('id', $advisoryIds)
                                ->orderBy('date', 'asc') 
                                ->take(7) 
                                ->get();
        
            return view('user.perfil', ['advisories' => $advisories]);
        }
        
        


        return view('user.perfil');
    }




    public function destroy(int $id)
    {
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $users = DB::table('users')
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        return view('user.search', ['users' => $users]);
    }





    public function showExternalPerfil(int $id)
    {
        $user = User::findOrFail($id);
        $user_role = $user->rol;

        $advisories = ($user_role == 'teacher')
            ? Advisory::where('teachers_id', $id)->get()
            : User_advisories::where('student_id', $id)->get();

        $exists = User_Teacher::where('users_id', Auth::user()->id)
            ->where('teachers_id', $id)
            ->exists();

        return view('user.externalPerfil')->with([
            'user' => $user,
            'advisories' => $advisories,
            'exists' => $exists
        ]);
    }



    public function followUser(int $studentId, int $teacherId)
    {
        try {
            $existingRecord = User_Teacher::where('users_id', $studentId)
                ->where('teachers_id', $teacherId)
                ->first();

            if ($existingRecord) {
                $existingRecord->delete();
            } else {
                User_Teacher::create([
                    'users_id' => $studentId,
                    'teachers_id' => $teacherId
                ]);
            }

            return redirect()->route('user.externalPerfil', ['id' => $teacherId]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar la solicitud', 'exception' => $e->getMessage()], 500);
        }
    }
}

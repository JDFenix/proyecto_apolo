<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LicenseValidatorController;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Models\Administrator;
use App\Models\Teachers;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\User;
use Exception;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{

    public function index()
    {
    }

    public function store(StoreUserRequest $request)
    {

        try {
            // $dataUser = $request->validate([
            //     'rol' => 'required|string|max:191',
            //     'name' => 'required|string|max:191',
            //     'date_birthday' => 'required',
            //     'paternal_surname' => 'required|string|max:191',
            //     'maternal_surname' => 'required|string|max:191',
            //     'sex' => 'required|string|max:191',
            //     'age' => 'required|int|max:110',
            //     'phone_number' => 'required|int',
            //     'email' => 'required|string|max:191',
            //     'password' => 'required|string|max:191|min:8|max:20',


            //     'career' =>'required|string|max:191',
            //     //data from teacher
            //     // 'license' => 'required|string|max:191',
            //     // 'professional_title' => 'required|string|max:191',
            //     // 'subjects_taught' => 'required|string|max:191',

            // ]);

            $dataUser = $request->validated();

            $url = 'https://api.dicebear.com/7.x/miniavs/svg?seed=';
            $nameUser  = $dataUser['name'];
            $dataUser['avatar'] = $url . $nameUser;

          
            $userCreated = User::create($dataUser);
      
            $verificationCode = rand(100000, 999999);
            $request->session()->put('verification_code', $verificationCode);
            Mail::to($dataUser['email'])->send(new VerificationMail($verificationCode, $dataUser['name']));

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
        } catch (Exception $e) {
            return response()->json('no se pudo registrar ' . $e);
        }
    }



    public function registerStudent(array $dataUser, object $userCreated)
    {
        $firstInitialName =  substr($dataUser['name'], 0, 1);
        $yearRegistered = $userCreated->created_at->year;
        $studentEnrollment = $userCreated->id . $yearRegistered . $firstInitialName . random_int(100, 999);

        Students::create([
            'users_id' => $userCreated->id,
            'career' => $dataUser['career'],
            'enrollment' => $studentEnrollment
        ]);
    }

    public function registerTeacher(array $dataUser, object $userCreated)
    {
        $dataTeacher = Teachers::create([
            'users_id' => $userCreated->id,
            'license' => $dataUser['license'],
            'professional_title' => $dataUser['professional_title'],
            'subjects_taught' => $dataUser['subjects_taught']
        ]);

        //     $licenseValidator = new LicenseValidatorController($dataTeacher['license']);
        //    return response()->json( $licenseValidator->getLicense());
        return redirect()->route('validator', ['license' => $dataTeacher['license']]);
    }

    public function registerAdmin(array $dataUser, object $userCreated)
    {
        Administrator::create([
            'users_id' => $userCreated->id,
        ]);
    }

    public function show(int $id)
    {
    }

    public function edit(int $id)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(int $id)
    {
    }
}

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
      
            $dataUser = $request->validated();

            $url = 'https://api.dicebear.com/7.x/miniavs/svg?seed=';
            $nameUser  = $dataUser['name'];
            $dataUser['avatar'] = $url . $nameUser;


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
            'enrollment' => $studentEnrollment
        ]);

    }

    public function registerTeacher(array $dataUser, object $userCreated)
    {
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

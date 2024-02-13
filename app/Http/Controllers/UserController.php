<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Models\Administrator;
use App\Models\Teachers;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\User;
use Exception;

class UserController extends Controller
{
 
    public function index()
    {
        return view('student.register');
    }

    public function store(Request $request)
    {

        try {
            $dataUser = $request->validate([
                'rol' => 'required|string|max:191',
                'name' => 'required|string|max:191',
                'date_birthday' => 'required',
                'paternal_surname' => 'required|string|max:191',
                'maternal_surname' => 'required|string|max:191',
                'email' => 'required|string|max:191',
                'password' => 'required|string|max:191|min:8|max:20',
                'license' => 'string|max:191'
            ]);
            // dd($dataUser['date_birthday']);
            $userCreated = User::create($dataUser);

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

            $verificationCode = rand(100000, 999999);
            $request->session()->put('verification_code', $verificationCode);
            Mail::to($dataUser['email'])->send(new VerificationMail($verificationCode, $dataUser['name']));


             return response()->json(['message' => 'Código de verificación enviado']);

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
            'enrollment' => $studentEnrollment
        ]);
    }

    public function registerTeacher(array $dataUser, object $userCreated)
    {

        Teachers::create([
            'users_id' => $userCreated->id,
            'license' => $dataUser['license']
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

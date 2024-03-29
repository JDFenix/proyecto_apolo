<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LicenseValidatorController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//views recovery password
Route::get('/', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/olvidar_contraseña', function () {
    return view('auth.forgetPassword');
})->name('forgetPassword')->middleware('guest');

Route::get('/recuperar_contraseña', function () {
    return view('auth.recoverPassword');
})->name('recoverPassword')->middleware('guest');

Route::get('/confirmacion_contraseña', function () {
    return view('auth.confirmPassword');
})->name('confirmPassword')->middleware('guest');




//routes auth
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//register teacher
Route::get('/cedula/validador',  function () {
    return view('auth.licenseValidator');
})->name('teacher.validator')->middleware('guest');

Route::get('/registro/maestro', function () {
    return view('teacher.register');
})->name('teacher.register')->middleware('guest');

Route::post('/validar', [LicenseValidatorController::class, 'getLicense'])->name('validator');


//student
Route::get('/registro/estudiante',  function () {
    return view('student.register');
})->name('student.register');




//register and logout user
Route::get('/register', [UserController::class, 'index']);
Route::post('/registerUser', [UserController::class, 'store'])->name('register');



//user
Route::get('/inicio',  function () {
    return view('user.index');
})->name('home')->middleware('auth');

route::get('/seleccionar/rol', function () {
    return view('user.selectRol');
})->name('user.selectRol')->middleware('guest');

Route::get('/confirmacion',  function () {
    return view('user.confirmRegister');
})->name('user.confirmRegister')->middleware('guest');

Route::get('/perfil',  function () {
    return view('user.perfil');
})->name('user.perfil')->middleware('auth');

Route::get('/contacto',  function () {
    return view('user.contact');
})->name('user.contact');

Route::get('/modificar',  function () {
    return view('user.modify');
})->name('user.modify');




//advisory
Route::get('/crear-asesoria',  function () {
    return view('advisory.create');
})->name('advisory.create')->middleware('auth');

Route::get('/modificar-asesoria',  function () {
    return view('advisory.modify');
})->name('advisory.modify')->middleware('auth');

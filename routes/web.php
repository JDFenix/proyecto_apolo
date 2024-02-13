<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('student.register');
})->name('home');


Route::get('/register',[UserController::class, 'index']);
Route::post('/registerUser',[UserController::class, 'store' ])->name('register');

//auth

// Route::get('/login',[AuthController::class, 'index'])->name('loginView');
Route::get('/loginsView', function(){
    return view('auth.login');
})->name('loginView');

Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');


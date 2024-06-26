<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rolUser = $request['rol'];
        $rolUser = $rolUser == 'teacher' ? 'maestro' : ($rolUser == 'student' ? 'estudiante' : $rolUser);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            session(['rolUser' => $rolUser]);

            return  redirect()->route('home');
        } else {
            return response()->json('credentials bad');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('auth.login');
    }
}

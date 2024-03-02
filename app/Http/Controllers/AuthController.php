<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $dataUser = $request->only('email', 'password');
        $rolUser = $request['rol'];
    
        if (Auth::attempt($dataUser)) {
            request()->session()->regenerate();
    
            $rolUser = $rolUser == 'teacher' ? 'maestro' : ($rolUser == 'student' ? 'estudiante' : $rolUser);

            session(['rolUser' => $rolUser]);
    
            return redirect()->route('home');
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

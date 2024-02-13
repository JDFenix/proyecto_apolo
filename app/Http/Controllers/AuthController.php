<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  
public function index(){
    return view('auth.login');
}

    public function login(Request $request)
    {

        $dataUser = $request->only('email', 'password');

        if (Auth::attempt($dataUser)) {
            request()->session()->regenerate();

            return redirect()->route('home');
        }else{
            return response()->json('credentials bad');
        }
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}

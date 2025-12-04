<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function show_login(){
        return view('LoginPage');
    }

    public function dashboard(){
        return view('beranda'); 
    }

    public function login_validate(Request $request)
    {
        $datalog = [
            'username' => $request->usernamelgn, 
            'password' => $request->passwordlgn,
        ];

        if (Auth::attempt($datalog)){
            
            return redirect()->route('dashboard');
        } else {

            return back()->withq('error', 'Login Gagal, Terdapat kesalahan pada username atau password');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }


}

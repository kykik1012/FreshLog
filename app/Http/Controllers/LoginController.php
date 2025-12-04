<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // 1. Validasi Input
        $request->validate([
            'usernamelgn' => 'required',
            'passwordlgn' => 'required'
        ]);

        $datalog = [
            'username' => $request->usernamelgn, 
            'password' => $request->passwordlgn,
        ];

        // 2. Cek Username & Password (Login Biasa)
        if (Auth::attempt($datalog)){
            $request->session()->regenerate();
            // Langsung masuk dashboard tanpa OTP
            return redirect()->route('dashboard');
        } else {
            return back()->with('error', 'Login Gagal, username atau password salah.');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function show_login(){
        return view('LoginPage'); // Pastikan nama file blade login kamu benar
    }

    // Fungsi ini tidak terlalu diperlukan lagi karena sudah ada di Route::get('/dashboard')
    // tapi kalau mau dipakai, pastikan view-nya 'beranda'
    public function dashboard(){
        return view('beranda'); 
    }

    public function login_validate(Request $request)
    {
        $datalog = [
            'username' => $request->usernamelgn, // Pastikan 'name' di input HTML login adalah 'usernamelgn'
            'password' => $request->passwordlgn, // Pastikan 'name' di input HTML login adalah 'passwordlgn'
        ];

        if (Auth::attempt($datalog)){
            $request->session()->regenerate(); // Penting untuk keamanan sesi
            return redirect()->route('dashboard'); // Redirect ke route yang bernama 'dashboard'
        } else {
            // Perbaikan: gunakan back() agar kembali ke halaman login, bukan route '/' yang error
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

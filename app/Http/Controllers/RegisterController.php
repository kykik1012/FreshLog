<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth; 

class RegisterController extends Controller
{
    public function show_register(){
        return view('RegisterPage'); 
    }

    public function register_validate(Request $request){
        

        $request->validate([
            'namereg' => 'required|max:255',
            'usernamereg' => 'required|unique:users,username|alpha_dash',
            'emailreg' => 'required|email|unique:users,email',
            'passwordreg' => 'required|min:8',
            'conpasswordreg' => 'required|same:passwordreg',
        ], [

            'usernamereg.unique' => 'Username ini sudah dipakai.',
            'emailreg.unique' => 'Email ini sudah terdaftar.',
            'conpasswordreg.same' => 'Konfirmasi password tidak cocok.'
        ]);


        $datareg = [
            'name' => $request->namereg,
            'username' => $request->usernamereg,
            'email' => $request->emailreg,
            // PENTING: Password harus di-Hash (dienkripsi)
            'password' => Hash::make($request->passwordreg) 
        ];

        User::create($datareg);


        $datalog = [
            'username' => $request->usernamereg,
            'password' => $request->passwordreg, 
        ];

        if (Auth::attempt($datalog)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat Datang.');
        } else {
            return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
        }
    }
}
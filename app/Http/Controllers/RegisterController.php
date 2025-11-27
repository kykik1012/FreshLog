<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import Model User
use Illuminate\Support\Facades\Hash; // Import untuk enkripsi password
use Illuminate\Support\Facades\Auth; // Import Auth

class RegisterController extends Controller
{
    public function show_register(){
        // Pastikan nama file blade kamu 'register.blade.php' (atau sesuaikan)
        return view('RegisterPage'); 
    }

    public function register_validate(Request $request){
        
        // 1. Validasi Input
        $request->validate([
            'namereg' => 'required|max:255',
            'usernamereg' => 'required|unique:users,username|alpha_dash',
            'emailreg' => 'required|email|unique:users,email',
            'passwordreg' => 'required|min:8',
            'conpasswordreg' => 'required|same:passwordreg',
        ], [
            // Custom pesan error (opsional)
            'usernamereg.unique' => 'Username ini sudah dipakai.',
            'emailreg.unique' => 'Email ini sudah terdaftar.',
            'conpasswordreg.same' => 'Konfirmasi password tidak cocok.'
        ]);

        // 2. Siapkan Data untuk disimpan
        $datareg = [
            'name' => $request->namereg,
            'username' => $request->usernamereg,
            'email' => $request->emailreg,
            // PENTING: Password harus di-Hash (dienkripsi)
            'password' => Hash::make($request->passwordreg) 
        ];
       
        // 3. Simpan ke Database
        User::create($datareg);

        // 4. Otomatis Login setelah Register
        $datalog = [
            'username' => $request->usernamereg,
            'password' => $request->passwordreg, // Gunakan password asli untuk attempt login
        ];

        if (Auth::attempt($datalog)){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat Datang.');
        } else {
            return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail; // Tambahkan ini
use App\Mail\OtpMail; // Tambahkan ini
use Carbon\Carbon; // Tambahkan ini

class RegisterController extends Controller
{
    public function show_register(){
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
            'usernamereg.unique' => 'Username ini sudah dipakai.',
            'emailreg.unique' => 'Email ini sudah terdaftar.',
            'conpasswordreg.same' => 'Konfirmasi password tidak cocok.'
        ]);

        // 2. Buat User Baru
        // Kita buat user dulu, tapi belum kita login-kan (Auth::login)
        $datareg = [
            'name' => $request->namereg,
            'username' => $request->usernamereg,
            'email' => $request->emailreg,
            'password' => Hash::make($request->passwordreg),
            // Set OTP langsung saat create
            'otp_code' => rand(100000, 999999),
            'otp_expires_at' => Carbon::now()->addMinutes(5)
        ];

        $user = User::create($datareg);

        // 3. Kirim Email OTP
        try {
            Mail::to($user->email)->send(new OtpMail($user->otp_code));
        } catch (\Exception $e) {
            $user->delete();
            return back()->with('error', 'Gagal mengirim email OTP.');
        }

        // --- UBAH BAGIAN INI ---

        // 4. Simpan username ke session menggunakan method 'put'
        $request->session()->put('registration_username', $request->usernamereg);
        
        // PENTING: Paksa simpan session sekarang juga sebelum redirect!
        $request->session()->save(); 

        // 5. Arahkan ke Halaman Verifikasi OTP
        return redirect()->route('otp.form')->with('success', 'Registrasi berhasil! Cek email Anda.');
    }

    // --- LOGIKA OTP PINDAHAN DARI LOGIN CONTROLLER ---

    public function show_otp_form()
    {
        // Cek apakah ada user yang sedang proses registrasi?
        if (!session('registration_username')) {
            return redirect()->route('register');
        }
        return view('VerivOTP'); 
    }

    public function verify_otp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        // Ambil username dari session registrasi
        $username = session('registration_username');
        
        // Cari user
        $user = User::where('username', $username)->first();

        // Cek Validasi OTP
        if ($user && $user->otp_code == $request->otp && Carbon::now()->lessThanOrEqualTo($user->otp_expires_at)) {
            
            // --- SUKSES ---
            
            // Login User Secara Resmi
            Auth::login($user);

            // Bersihkan OTP
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->email_verified_at = Carbon::now(); // Opsional: Menandakan email sudah valid
            $user->save();

            // Hapus session sementara
            $request->session()->forget('registration_username');
            $request->session()->regenerate();

            // Masuk Dashboard
            return redirect()->route('dashboard')->with('success', 'Verifikasi Berhasil! Selamat Datang.');
        }

        // --- GAGAL ---
        return back()->with('error', 'Kode OTP salah atau sudah kadaluarsa!');
    }
}
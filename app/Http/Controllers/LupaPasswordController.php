<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpMail; // Kita gunakan Mail yang sama dengan Register
use Carbon\Carbon;

class LupaPasswordController extends Controller
{
    // 1. Tampilkan Form Input Email
    public function showLinkRequestForm()
    {
        return view('InputEmail');
    }

    // 2. Proses Kirim OTP ke Email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tersebut tidak terdaftar di sistem kami.'
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate OTP
        $user->otp_code = rand(100000, 999999);
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Kirim Email
        try {
            Mail::to($user->email)->send(new OtpMail($user->otp_code));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Coba lagi nanti.');
        }

        // Simpan email ke session agar bisa dipakai di tahap selanjutnya
        $request->session()->put('reset_email', $user->email);

        return redirect()->route('password.otp')->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    // 3. Tampilkan Form Input OTP
    public function showOtpForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }
        return view('VerivLupaPassword');
    }

    // 4. Verifikasi OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        $email = session('reset_email');
        $user = User::where('email', $email)->first();

        if ($user && $user->otp_code == $request->otp && Carbon::now()->lessThanOrEqualTo($user->otp_expires_at)) {
            
            // Tandai bahwa user ini sudah lolos verifikasi OTP di session
            $request->session()->put('otp_verified', true);
            
            // Bersihkan OTP di DB agar tidak bisa dipakai ulang (opsional, tapi aman dilakukan nanti saat reset)
            
            return redirect()->route('password.reset')->with('success', 'OTP Benar! Silakan buat password baru.');
        }

        return back()->with('error', 'Kode OTP salah atau sudah kadaluarsa.');
    }

    // 5. Tampilkan Form Reset Password Baru
    public function showResetForm()
    {
        // Cegah akses tembak url langsung tanpa verifikasi OTP
        if (!session('reset_email') || !session('otp_verified')) {
            return redirect()->route('password.request');
        }

        return view('BaruPassword');
    }

    // 6. Proses Simpan Password Baru
    public function resetPassword(Request $request)
    {
        // Validasi lagi session
        if (!session('reset_email') || !session('otp_verified')) {
            return redirect()->route('login')->with('error', 'Sesi habis, ulangi proses.');
        }

        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ], [
            'confirm_password.same' => 'Konfirmasi password tidak cocok.'
        ]);

        $email = session('reset_email');
        $user = User::where('email', $email)->first();

        // Update Password
        $user->password = Hash::make($request->password);
        $user->otp_code = null;       // Reset OTP
        $user->otp_expires_at = null; // Reset Expiry
        $user->save();

        // Hapus session
        $request->session()->forget(['reset_email', 'otp_verified']);

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login.');
    }
}
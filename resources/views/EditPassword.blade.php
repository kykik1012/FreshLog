@extends('layout.app')


@section('content')


{{-- Style Tambahan untuk Tema --}}
<style>
    /* Warna Tema */
    .bg-theme-secondary { background-color: #003539; }
    .text-theme-secondary { color: #003539; }
    .text-theme-primary { color: #AFEE00; }
   
    /* Custom Focus Ring */
    .focus-ring-theme:focus {
        border-color: #003539;
        box-shadow: 0 0 0 4px rgba(0, 53, 57, 0.1);
    }
</style>


<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10 px-4 font-['Inter']">


    <div class="bg-white w-full max-w-lg rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden relative">


        {{-- 1. Hiasan Header (Background Teal) --}}
        <div class="h-28 bg-theme-secondary relative">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#AFEE00 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>


        {{-- 2. Konten Utama --}}
        <div class="px-8 pb-8 relative -mt-12">


            {{-- Ikon Gembok Besar (Sebagai pengganti posisi Foto Profil) --}}
            <div class="flex justify-center mb-6">
                <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center shadow-lg border-4 border-white text-theme-secondary">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
            </div>


            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-theme-secondary">Ubah Password</h1>
                <p class="text-sm text-gray-400 mt-1">Amankan akun Anda dengan password yang kuat.</p>
            </div>


            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="p-4 mb-6 rounded-xl bg-red-50 text-red-700 border border-red-100 text-sm flex items-start gap-3">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- Alert Success --}}
            @if (session('success'))
                <div class="p-4 mb-6 rounded-xl bg-green-50 text-green-700 border border-green-100 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif


            <form action="/change-password" method="POST">
                @csrf


                <div class="space-y-5">
                   
                    {{-- Input Password Baru --}}
                    <div>
                        <label class="block text-sm font-bold text-theme-secondary mb-2">Password Baru</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-theme-secondary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" name="new_password" placeholder="Min. 8 karakter" required
                                   class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl outline-none transition-all text-gray-700 font-medium placeholder-gray-400 focus:bg-white focus-ring-theme">
                        </div>
                    </div>


                    {{-- Input Konfirmasi Password --}}
                    <div>
                        <label class="block text-sm font-bold text-theme-secondary mb-2">Konfirmasi Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-theme-secondary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <input type="password" name="confirm_password" placeholder="Ulangi password baru" required
                                   class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl outline-none transition-all text-gray-700 font-medium placeholder-gray-400 focus:bg-white focus-ring-theme">
                        </div>
                    </div>


                </div>


                <div class="mt-8 flex gap-4">
                    {{-- Tombol Kembali --}}
                    <a href="/dashboard" class="flex-1 py-3.5 rounded-xl border border-gray-200 text-gray-500 font-bold text-center hover:bg-gray-50 transition no-underline">
                        Batal
                    </a>


                    {{-- Tombol Simpan --}}
                    <button type="submit"
                            class="flex-1 py-3.5 rounded-xl bg-theme-secondary text-theme-primary font-bold shadow-lg hover:bg-opacity-90 hover:-translate-y-0.5 transition-all transform">
                        Simpan Password
                    </button>
                </div>


            </form>


            <p class="text-xs text-center text-gray-400 mt-6">
                Tips: Gunakan kombinasi huruf besar, angka, dan simbol.
            </p>
        </div>
    </div>


</div>
@endsection

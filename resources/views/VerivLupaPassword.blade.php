 @vite(['resources/css/app.css', 'resources/js/app.js'])
<div>
    <body class="bg-[#0f0f0f] text-white font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden p-4">
        
        <div class="fixed inset-0 -z-10 blur-[100px] opacity-30 bg-[radial-gradient(circle_at_80%_20%,#ff7a18,transparent_60%),radial-gradient(circle_at_20%_80%,#18b0ff,transparent_60%)]"></div>

        <div class="w-full max-w-[400px] bg-white/5 backdrop-blur-2xl rounded-3xl p-8 border border-white/10 shadow-2xl animate-[fadeUp_0.7s_ease-out]">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">Masukkan OTP</h2>
                <p class="text-white/60 text-sm">
                    Kode 6 digit telah dikirim ke <br>
                    <span class="text-white font-semibold">{{ session('reset_email') }}</span>
                </p>
            </div>

            @if(session('success'))
                <div class="mb-5 p-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('password.verify') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <input 
                        type="text" 
                        name="otp" 
                        placeholder="000000" 
                        required 
                        maxlength="6"
                        class="w-full px-4 py-4 text-center text-2xl tracking-[0.5em] font-mono rounded-xl bg-white/5 border border-white/10 text-white placeholder-white/20 focus:outline-none focus:bg-white/10 focus:border-white/30 focus:ring-1 focus:ring-white/30 transition-all duration-300"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6)"
                    >
                </div>
                
                <button 
                    type="submit" 
                    class="w-full py-3.5 rounded-xl bg-white text-black font-bold text-sm hover:bg-gray-200 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300"
                >
                    Verifikasi Kode
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('password.request') }}" class="text-sm text-white/40 hover:text-white transition-colors">
                    Salah email? Kembali
                </a>
            </div>
        </div>
    </div>
</body>
</div>

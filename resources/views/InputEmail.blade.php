    @vite(['resources/css/app.css', 'resources/js/app.js'])
<div>
    <body class="bg-[#0f0f0f] text-white font-sans antialiased">
    
    {{-- Wrapper Utama agar Center --}}
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden p-4">

        {{-- Background Gradient Blobs --}}
        <div class="fixed inset-0 -z-10 blur-[100px] opacity-30 bg-[radial-gradient(circle_at_20%_20%,#ff7a18,transparent_60%),radial-gradient(circle_at_80%_80%,#18b0ff,transparent_60%)]"></div>

        {{-- Card Container --}}
        <div class="w-full max-w-[400px] bg-white/5 backdrop-blur-2xl rounded-3xl p-8 border border-white/10 shadow-2xl animate-fade-up">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">Lupa Password?</h2>
                <p class="text-white/60 text-sm leading-relaxed">
                    Masukkan email terdaftar Anda untuk mendapatkan kode OTP reset password.
                </p>
            </div>

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="mb-5 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Alert Validation Error --}}
            @if ($errors->any())
                <div class="mb-5 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-medium text-white/80 mb-1.5 ml-1 uppercase tracking-wider">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        placeholder="contoh@email.com" 
                        required 
                        autocomplete="email"
                        autofocus
                        class="w-full px-4 py-3.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-white/30 focus:outline-none focus:bg-white/10 focus:border-white/30 focus:ring-1 focus:ring-white/30 transition-all duration-300"
                    >
                </div>
                
                <button 
                    type="submit" 
                    class="w-full py-3.5 rounded-xl bg-white text-black font-bold text-sm hover:bg-gray-200 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 shadow-lg shadow-white/10"
                >
                    Kirim Kode OTP
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-white/50 hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</body>
</div>

 @vite(['resources/css/app.css', 'resources/js/app.js'])
<div>
    <body class="bg-[#0f0f0f] text-white font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden p-4">
        
        <div class="fixed inset-0 -z-10 blur-[100px] opacity-30 bg-[radial-gradient(circle_at_50%_50%,#8b5cf6,transparent_60%)]"></div>

        <div class="w-full max-w-[400px] bg-white/5 backdrop-blur-2xl rounded-3xl p-8 border border-white/10 shadow-2xl animate-[fadeUp_0.7s_ease-out]">
            
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-white mb-2">Password Baru</h2>
                <p class="text-white/60 text-sm">
                    Silakan buat password baru untuk akun Anda.
                </p>
            </div>

            @if(session('success'))
                <div class="mb-5 p-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 p-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-medium text-white/80 mb-1.5 ml-1">Password Baru</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required 
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-white/30 focus:outline-none focus:bg-white/10 focus:border-white/30 transition-all"
                    >
                </div>

                <div>
                    <label class="block text-xs font-medium text-white/80 mb-1.5 ml-1">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        name="confirm_password" 
                        placeholder="••••••••" 
                        required 
                        class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-white/30 focus:outline-none focus:bg-white/10 focus:border-white/30 transition-all"
                    >
                </div>
                
                <button 
                    type="submit" 
                    class="w-full py-3.5 mt-2 rounded-xl bg-white text-black font-bold text-sm hover:bg-gray-200 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300"
                >
                    Simpan Password
                </button>
            </form>
        </div>
    </div>
</body>
</div>

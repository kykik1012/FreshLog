<div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<body class="bg-[#f5f6fa] flex justify-center items-center min-h-screen font-['Inter']">

    <div class="w-full max-w-[420px] bg-white rounded-2xl p-8 shadow-[0_8px_20px_rgba(0,0,0,0.08)] border border-gray-200 m-4">
        <div class="text-center text-[22px] font-semibold text-gray-800 mb-6">Ubah Password</div>

        @if ($errors->any())
            <div class="p-3 mb-4 rounded-lg bg-red-50 text-red-700 border border-red-200 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="p-3 mb-4 rounded-lg bg-green-50 text-green-700 border border-green-200 text-sm text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="/change-password" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-2">Password Baru</label>
                <input type="password" name="new_password" placeholder="Masukkan password baru" required
                       class="w-full p-3 border border-gray-300 rounded-xl text-[15px] outline-none transition focus:border-[#4a73ff] focus:ring-2 focus:ring-[#4a73ff]/20">
            </div>

            <div class="mb-2">
                <label class="block text-sm text-gray-600 mb-2">Konfirmasi Password</label>
                <input type="password" name="confirm_password" placeholder="Masukkan ulang password" required
                       class="w-full p-3 border border-gray-300 rounded-xl text-[15px] outline-none transition focus:border-[#4a73ff] focus:ring-2 focus:ring-[#4a73ff]/20">
            </div>

            <button type="submit" 
                    class="w-full mt-6 py-3.5 bg-[#4a73ff] text-white rounded-xl text-base font-semibold hover:bg-[#3c5ed8] transition shadow-sm">
                Simpan Password
            </button>
        </form>

        <button onclick="window.location.href='dashboard'" 
                class="w-full mt-3 py-3.5 bg-gray-100 text-gray-700 rounded-xl text-base font-semibold hover:bg-gray-200 transition">
            Kembali
        </button>

        <p class="text-xs text-center text-gray-400 mt-5">
            Pastikan password baru mudah diingat namun tetap aman.
        </p>
    </div>

</body>
</div>

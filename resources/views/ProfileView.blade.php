<div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="max-w-[550px] mx-auto">

        <div class="bg-white p-8 rounded-2xl text-center shadow-[0_4px_20px_rgba(0,0,0,0.07)]">
            <img 
                alt="Profile" 
                class="w-[120px] h-[120px] rounded-full object-cover border-4 border-blue-500 mx-auto mb-4" 
                src="{{ asset('storage/store_photo/' . $usernow->image_profile) }}"
            >

            <h2 class="text-2xl font-bold text-gray-900">{{ $usernow->name }}</h2>
            <p class="text-sm text-gray-500 my-1">{{ $usernow->username }}</p>
            <p class="text-gray-700 mb-5">{{ $usernow->email }}</p>
            
            <button 
                class="w-full py-3 rounded-xl bg-blue-500 text-white font-medium hover:bg-blue-600 transition duration-300 ease-in-out" 
                onclick="window.location.href='Edit-Profile'"
            >
                Edit Profile
            </button>
        </div>

        <div class="bg-white mt-6 p-5 rounded-2xl shadow-sm">
            <h3 class="text-lg font-bold mb-4 text-gray-800">Pengaturan Akun</h3>

            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-700">Riwayat Barang</span>
                <a href="edit_profile" class="text-blue-500 font-semibold hover:text-blue-600 transition">Lihat</a>
            </div>

            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-700">Keamanan Akun</span>
                <a href="/secure" class="text-blue-500 font-semibold hover:text-blue-600 transition">Kelola ></a>
            </div>

            <div class="flex justify-between items-center py-3 pt-4">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

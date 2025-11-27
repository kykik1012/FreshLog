<div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <div class="flex justify-end p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-700 font-bold">
                Logout
            </button>
        </form>
    </div>

    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->username ?? 'User' }}!</h1> 
        <p class="mb-6 text-gray-600">Kelola stok barang kamu di sini.</p>

        <a href="{{ route('item.index') }}" 
        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 mb-3">
            Lihat Semua Item
        </a>

        
        
        <a href="{{ route('penyimpanan.index') }}" 
        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
            Lihat Penyimpanan
        </a>
    </div>
</div>
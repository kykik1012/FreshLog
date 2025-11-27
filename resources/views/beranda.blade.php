<div>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang!</h1>
        <p class="mb-6 text-gray-600">Kelola stok barang kamu di sini.</p>


        <a href="{{ route('item.index') }}" 
        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
            Lihat Semua Item
        </a>


        <a href="{{ route('get.item') }}" 
        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
            + Tambah makan Baru
        </a>
        
        <a href="{{ route('penyimpanan.index') }}" 
        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
            Lihat Penyimpanan
        </a>
    </div>
</div>

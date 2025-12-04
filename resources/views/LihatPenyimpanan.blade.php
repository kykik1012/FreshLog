<div class="max-w-4xl mx-auto">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Penyimpanan</h2>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('get.item') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm text-sm font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Penyimpanan
            </a>
            <a href="{{ route('penyimpanan.history') }}" class="bg-white text-gray-700 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-50 transition shadow-sm text-sm font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Riwayat
            </a>
        </div>
    </div>

    {{-- LIST CONTENT --}}
    <div class="space-y-4">
        @forelse($penyimpanans as $data)
            <div class="flex justify-between items-center bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition duration-200">
        
        {{-- Bagian Kiri: Gambar & Info --}}
        <div class="flex items-center gap-4">
            {{-- Menampilkan Gambar --}}
            <div class="w-16 h-16 flex-shrink-0">
                @if($data->foto)
                    <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto" class="w-full h-full object-cover rounded-lg border border-gray-100">
                @else
                    {{-- Placeholder jika tidak ada foto --}}
                    <div class="w-full h-full bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Info Text --}}
            <div>
                <h3 class="text-gray-800 font-medium text-lg">
                    {{ $data->item->nama_item ?? 'Item tidak ditemukan' }}
                </h3>
                
                <p class="text-gray-500 text-sm mt-1">
                    {{ $data->lokasi->nama_lokasi ?? '-' }} 
                    &bull; 
                    <span class="text-gray-600 font-medium">{{ $data->kuantitas }} {{ $data->item->satuan ?? '' }}</span>
                </p>
            </div>
        </div>

        {{-- Bagian Kanan: Badge & Action Buttons (Tetap sama seperti kodemu) --}}
        <div class="flex items-center gap-3">
             {{-- ... Kode Badge & Tombol Edit/Hapus kamu tetap disini ... --}}
        </div>

    </div>
        @empty
            <div class="text-center py-10 text-gray-500 bg-white rounded-xl border border-gray-200 shadow-sm">
                Belum ada data penyimpanan.
            </div>
        @endforelse
    </div>
</div>
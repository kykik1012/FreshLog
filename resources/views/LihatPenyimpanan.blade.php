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
                
                {{-- Badge Status --}}
                <span class="{{ $data->badge_color }} px-3 py-1 rounded-full text-sm font-semibold shadow-sm">
                    @if($data->sisa_hari_angka < 0)
                        Kadaluarsa
                    @elseif($data->sisa_hari_angka == 0)
                        Hari ini
                    @else
                        {{ $data->sisa_hari_angka }} hari
                    @endif
                </span>

                {{-- ACTION BUTTONS (Edit & Delete) --}}
                <div class="flex items-center border-l border-red-200 pl-3 gap-2">
                    
                    {{-- Tombol Edit --}}
                    <a href="{{ route('penyimpanan.edit', $data->id) }}" class="p-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition border border-gray-200 shadow-sm" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </a>

                    <form action="{{ route('penyimpanan.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-white text-red-600 rounded-lg hover:bg-red-50 transition border border-gray-200 shadow-sm" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

    </div>
        @empty
            <div class="text-center py-10 text-gray-500 bg-white rounded-xl border border-gray-200 shadow-sm">
                Belum ada data penyimpanan.
            </div>
        @endforelse
    </div>
</div>
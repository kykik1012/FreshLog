    @vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="max-w-4xl mx-auto">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Item</h2>
        <a href="{{ route('item.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm text-sm font-medium">
            + Tambah Item
        </a>
        <a href="{{ route('item.riwayat_index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm text-sm font-medium">
            Riwayat Item
        </a>
    </div>


    <div class="space-y-4">
        
        @forelse($items as $item)
            <div class="flex justify-between items-center bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition duration-200">
                
                {{-- BAGIAN KIRI: Info Item --}}
                <div>
                    <h3 class="text-gray-800 font-medium text-lg">
                        {{ $item->nama_item }}
                    </h3>
                    
                    <p class="text-gray-500 text-sm mt-1">
                        {{-- Mengambil nama kategori jika ada relasi, jika tidak tampilkan ID --}}
                        {{ $item->kategori->nama_kategori ?? 'Kategori #' . $item->kategori_item_id }} 
                        &bull; 
                        <span class="text-gray-600">{{ $item->satuan }}</span>
                    </p>
                </div>

                {{-- BAGIAN KANAN: Badge & Tombol --}}
                <div class="flex items-center gap-3">
                    
                    {{-- Badge Status (Statik karena is_delete=0 pasti aktif) --}}
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold shadow-sm border border-green-200">
                        Aktif
                    </span>

                    {{-- ACTION BUTTONS (Edit & Delete) --}}
                    <div class="flex items-center border-l border-gray-200 pl-3 gap-2">
                        
                        {{-- Tombol Edit --}}
                        <a href="{{ route('item.edit', $item->id) }}" class="p-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition border border-gray-200 shadow-sm group" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>

                        {{-- Tombol Delete --}}
                        <form action="{{ route('item.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $item->nama_item }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-white text-red-600 rounded-lg hover:bg-red-50 transition border border-gray-200 shadow-sm group" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition-transform">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-10 text-gray-500 bg-white rounded-xl border border-gray-200">
                Belum ada item yang terdaftar.
            </div>
        @endforelse
    </div>
</div>
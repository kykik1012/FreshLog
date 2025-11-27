    @vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="max-w-4xl mx-auto">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Item Dihapus</h2>
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
                    <span class="bg-red-700 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-sm border border-green-200">
                        Deleted
                    </span>

                    {{-- ACTION BUTTONS (Edit & Delete) --}}
                    <div class="card">
                        <p>{{ $item->nama }}</p>
                        <form action="{{ route('item.restore', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengembalikan item ini?')">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded">
                                Restore
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
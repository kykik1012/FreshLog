<div class="space-y-4">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('penyimpanan.index') }}" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Item</h2>
        </div>
    </div>

    @if($histories->isEmpty())
        <div class="text-center py-10 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <p class="text-gray-500">Belum ada riwayat item yang dihapus.</p>
        </div>
    @else
        @foreach($histories as $data)
            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl border border-gray-200 opacity-90 hover:opacity-100 transition">
                

                <div>
                    <h3 class="text-gray-700 font-medium text-lg line-through decoration-gray-400">
                        {{ $data->item->nama_item ?? 'Item tidak ditemukan' }}
                    </h3>
                    
                    <p class="text-gray-500 text-sm mt-1">
                        {{ $data->lokasi->nama_lokasi ?? '-' }} 
                        &bull; 
                        {{ $data->kuantitas }} {{ $data->item->satuan ?? '' }}
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        Dihapus pada: {{ \Carbon\Carbon::parse($data->updated_at)->format('d M Y, H:i') }}
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold shadow-sm 
                        {{ $data->status == 'Dihapus' ? 'bg-red-100 text-red-600 border border-red-200' : 'bg-gray-200 text-gray-600' }}">
                        {{ $data->status }}
                    </span>
                </div>
            </div>
        @endforeach
    @endif
</div>
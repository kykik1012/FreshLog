@extends('layout.app')


@section('content')
   
    <div class="flex items-center gap-3 mb-6">
        <h1 class="text-2xl font-bold text-secondary">Makanan yang Kini Anda Miliki</h1>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
       
        @forelse($items as $item)
        <div class="bg-white rounded-3xl p-4 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-lg transition duration-300 relative group border border-transparent hover:border-primary">
           
            <div class="absolute top-4 right-4 z-10">
                <button class="text-gray-300 hover:text-secondary transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                </button>
            </div>


            <div class="h-32 w-full bg-gray-50 rounded-2xl mb-3 flex items-center justify-center overflow-hidden relative">
                @if($item->foto)
                    {{-- PERBAIKAN DISINI: Menambahkan folder 'item_photo/' --}}
                    <img src="{{ asset('storage/item_photo/' . $item->foto) }}" class="w-full h-full object-cover">
                @else
                    {{-- Placeholder jika tidak ada foto --}}
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                @endif
               
                <span class="absolute bottom-2 left-2 px-2 py-1 rounded-lg text-[10px] font-bold text-secondary bg-primary">
                    Aman
                </span>
            </div>


            <div>
                <h3 class="font-bold text-darkGrey text-base truncate">{{ $item->nama_item }}</h3>
                <p class="text-gray-400 text-xs mb-3">{{ $item->kategoriItem->nama_kategori ?? 'Umum' }}</p>
                {{-- Catatan: Pastikan nama relasi di Model Item adalah 'kategoriItem' atau 'kategori' --}}
               
                <div class="flex justify-between items-center">
                    <span class="text-sm font-semibold text-secondary bg-gray-100 px-3 py-1 rounded-full">
                        {{ $item->stok ?? 0 }} {{ $item->satuan ?? 'Pcs' }}
                    </span>
                </div>
            </div>
        </div>
        @empty
            <div class="col-span-full text-center py-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                     <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-gray-800 font-bold">Belum ada barang</h3>
                <p class="text-gray-400 text-sm">Tekan tombol (+) untuk mulai mencatat.</p>
            </div>
        @endforelse


    </div>


@endsection

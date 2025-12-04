@extends('layout.app')


@section('content')


    <!-- Header Page -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('penyimpanan.index') }}" class="p-2 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-secondary hover:border-secondary transition shadow-sm group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-secondary">Riwayat Mutasi Stok</h1>
                <p class="text-sm text-gray-500">Log aktivitas barang masuk dan keluar dari penyimpanan.</p>
            </div>
        </div>


        <!-- Filter Sederhana (Opsional) -->
        <div class="flex bg-white p-1 rounded-xl border border-gray-200 shadow-sm">
            <button class="px-4 py-1.5 rounded-lg text-xs font-bold bg-secondary text-primary shadow-sm">Semua</button>
            <button class="px-4 py-1.5 rounded-lg text-xs font-bold text-gray-500 hover:bg-gray-50">Masuk</button>
            <button class="px-4 py-1.5 rounded-lg text-xs font-bold text-gray-500 hover:bg-gray-50">Keluar</button>
        </div>
    </div>


    <!-- Timeline List -->
    <div class="space-y-4">
        @forelse($histories as $data)
            @php
                // Logika Visual Sederhana
                // Sesuaikan status dengan data di database Anda (misal: 'Masuk', 'Keluar', 'Dihapus', 'Kadaluarsa')
                $isOut = in_array($data->status, ['Dihapus', 'Keluar', 'Kadaluarsa']);
               
                // Warna Icon & Text
                $iconColor = $isOut ? 'text-red-500 bg-red-50' : 'text-green-500 bg-green-50';
                $textColor = $isOut ? 'text-red-500' : 'text-green-600';
                $badgeColor = $isOut ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600';
               
                // Border Kiri Card
                $borderColor = $isOut ? 'border-l-red-400' : 'border-l-primary';
               
                // Icon SVG
                $icon = $isOut
                    ? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>'
                    : '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>';
            @endphp


            <!-- Card Log -->
            <div class="bg-white rounded-2xl p-5 shadow-[0_2px_10px_rgba(0,0,0,0.02)] border border-gray-100 hover:border-gray-300 transition flex items-center justify-between group border-l-4 {{ $borderColor }}">
               
                <div class="flex items-center gap-4">
                    <!-- Icon Status -->
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 {{ $iconColor }}">
                        {!! $icon !!}
                    </div>


                    <!-- Info Barang -->
                    <div>
                        <h3 class="font-bold text-darkGrey text-base">
                            {{ $data->item->nama_item ?? 'Item Tidak Dikenal' }}
                        </h3>
                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 mt-1">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $data->lokasi->nama_lokasi ?? '-' }}
                            </span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>
                </div>


                <!-- Kuantitas & Status -->
                <div class="text-right">
                    <span class="block font-bold text-lg {{ $textColor }}">
                        {{ $isOut ? '-' : '+' }} {{ $data->kuantitas }}
                        <span class="text-xs font-normal text-gray-400">{{ $data->item->satuan ?? '' }}</span>
                    </span>
                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $badgeColor }}">
                        {{ $data->status }}
                    </span>
                </div>


            </div>
        @empty
            <!-- Empty State -->
            <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-gray-800 font-bold text-lg">Belum Ada Aktivitas</h3>
                <p class="text-gray-400 text-sm mt-1">Data riwayat akan muncul setelah Anda menambah atau menghapus stok.</p>
            </div>
        @endforelse
    </div>

@endsection

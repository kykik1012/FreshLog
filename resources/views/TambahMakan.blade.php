{{-- Cek apakah ini mode Edit atau Tambah --}}
@php
    $isEdit = isset($dataEdit); 
    // Jika edit, arahkan ke route update. Jika tambah, ke route store.
    $actionUrl = $isEdit ? route('penyimpanan.update', $dataEdit->id) : route('penyimpanan.store');
@endphp

<div class="p-4">
    <a href="{{ route('penyimpanan.index') }}" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
    <h2 class="text-xl font-bold mb-4">{{ $isEdit ? 'Edit Data Penyimpanan' : 'Tambah Data Penyimpanan' }}</h2>

    <form action="{{ $actionUrl }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @if($isEdit)
            @method('PUT')
        @endif

        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-3">
            <label class="block font-semibold mb-1">Item *</label>
            <select name="kategori_item_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300" required>
                <option value="" disabled {{ !$isEdit ? 'selected' : '' }}>-- Pilih Item --</option>
                @foreach($item as $makan)
                    <option value="{{ $makan->id }}" 
                        {{-- Logika Selected: Cek old input (jika gagal validasi) ATAU cek data database --}}
                        {{ (old('kategori_item_id', $dataEdit->item_id ?? '') == $makan->id) ? 'selected' : '' }}>
                        {{ $makan->nama_item }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-3 mb-3">
            <label class="block font-semibold mb-1">Lokasi *</label>
            <select name="lokasi_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300" required>
                <option value="" disabled {{ !$isEdit ? 'selected' : '' }}>-- Pilih Lokasi --</option>
                @foreach($lokasi as $loc)
                    <option value="{{ $loc->id }}" 
                        {{ (old('lokasi_id', $dataEdit->lokasi_id ?? '') == $loc->id) ? 'selected' : '' }}>
                        {{ $loc->nama_lokasi }}
                    </option> 
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="tanggal_simpan">Tanggal Simpan</label>
            {{-- Value: old -> database -> kosong --}}
            <input type="date" name="tanggal_simpan" id="tanggal_simpan" class="form-control p-2 border rounded w-full" 
                value="{{ old('tanggal_simpan', $dataEdit->tanggal_simpan ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
            <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" class="form-control p-2 border rounded w-full" 
                value="{{ old('tanggal_kadaluarsa', $dataEdit->tanggal_kadaluarsa ?? '') }}" required>
        </div>


        <div class="mb-3">
            <label for="kuantitas">Kuantitas</label>
            <input type="number" name="kuantitas" id="kuantitas" class="form-control p-2 border rounded w-full" min="0" 
                value="{{ old('kuantitas', $dataEdit->kuantitas ?? '') }}" required>
        </div>

        <div class="mb-3">
        <label class="block font-semibold mb-1">Foto Item (Opsional)</label>
        
        {{-- Preview jika sedang edit dan ada fotonya --}}
        @if($isEdit && isset($dataEdit->foto))
            <div class="mb-2">
                <img src="{{ asset('storage/' . $dataEdit->foto) }}" alt="Preview" class="w-32 h-32 object-cover rounded-lg border">
                <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
            </div>
        @endif

        <input type="file" name="foto" class="block w-full text-sm text-gray-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-blue-50 file:text-blue-700
            hover:file:bg-blue-100
        "/>
    </div>
        

        <div class="flex gap-2 mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                {{ $isEdit ? 'Update Perubahan' : 'Simpan Data' }}
            </button>
            
            <a href="{{ route('penyimpanan.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                Batal
            </a>
        </div>
    </form>
</div>
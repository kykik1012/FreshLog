
@php
    $isEdit = isset($itemEdit); // Cek apakah variabel $itemEdit dikirim dari controller
    $url = $isEdit ? route('item.update', $itemEdit->id) : route('item.store');
@endphp

<form action="{{ $url }}" method="POST">
    @csrf 
    {{-- Jika mode Edit, tambahkan Method PUT --}}
    @if($isEdit)
        @method('PUT')
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <a href="{{ route('item.index') }}" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
    <h2 class="text-xl font-bold mb-4">{{ $isEdit ? 'Edit Barang' : 'Tambah Barang Baru' }}</h2>

    <div>
        <label class="block font-semibold mb-1">Nama Barang *</label>
        <input type="text" name="nama_item" 
            value="{{ old('nama_item', $itemEdit->nama_item ?? '') }}"
            placeholder="Contoh: Daging Ayam"
            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300" required />
    </div>

    <div class="mt-3">
        <label class="block font-semibold mb-1">Satuan *</label>
        <input type="text" name="satuan" 
            value="{{ old('satuan', $itemEdit->satuan ?? '') }}"
            placeholder="Contoh: Gram"
            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300" required />
    </div>

    <div class="mt-3">
        <label class="block font-semibold mb-1">
            Kategori Item *
            <span class="text-sm text-green-600">(Relasi Database)</span>
        </label>
        <select name="kategori_item_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300" required>
            <option value="" disabled {{ !$isEdit ? 'selected' : '' }}>-- Pilih Kategori --</option>
            
            @foreach($kategori as $cat)
                <option value="{{ $cat->id }}" 
                    {{ (old('kategori_item_id', $itemEdit->kategori_item_id ?? '') == $cat->id) ? 'selected' : '' }}>
                    {{ $cat->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-6 flex gap-2">
        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Barang' }}
        </button>
        
        <a href="{{ route('item.index') }}" class="w-full text-center bg-gray-200 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-300">
            Batal
        </a>
    </div>
</form>
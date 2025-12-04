@extends('layout.app')


@section('content')

@php
    $isEdit = isset($itemEdit) && $itemEdit !== null;
    $url = $isEdit ? route('item.update', $itemEdit->id) : route('item.store');
    $title = $isEdit ? 'Edit Barang' : 'Tambah Barang Baru';
@endphp



<div class="max-w-3xl mx-auto">
   
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('item.index') }}" class="p-2 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-secondary hover:border-secondary transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-secondary">{{ $title }}</h1>
            <p class="text-sm text-gray-500">Lengkapi form di bawah ini.</p>
        </div>
    </div>


    <div class="bg-white rounded-3xl p-8 shadow-[0_2px_15px_rgba(0,0,0,0.03)] border border-gray-100">
       
        <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($isEdit) @method('PUT') @endif


            <div class="space-y-6">
               
                {{-- Input Nama Barang --}}
                <div>
                    <label class="block text-sm font-semibold text-secondary mb-2">Nama Barang <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <input type="text" name="nama_item"
                            value="{{ old('nama_item', $itemEdit->nama_item ?? '') }}"
                            placeholder="Contoh: Daging Sapi"
                            class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all text-gray-700 placeholder-gray-400 font-medium @error('nama_item') border-red-500 @enderror"
                            required>
                    </div>
                    @error('nama_item')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                   
                    {{-- Input Satuan --}}
                    <div>
                        <label class="block text-sm font-semibold text-secondary mb-2">Satuan <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                            </div>
                            <input type="text" name="satuan"
                                value="{{ old('satuan', $itemEdit->satuan ?? '') }}"
                                placeholder="Kg, Pcs, Bungkus"
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all text-gray-700 placeholder-gray-400 font-medium @error('satuan') border-red-500 @enderror"
                                required>
                        </div>
                        @error('satuan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Input Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold text-secondary mb-2">Kategori <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>


                            <select name="kategori_item_id"
                                class="w-full pl-12 pr-10 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all text-gray-700 font-medium appearance-none cursor-pointer @error('kategori_item_id') border-red-500 @enderror"
                                required>
                                <option value="" disabled {{ !$isEdit ? 'selected' : '' }} class="text-gray-400">-- Pilih Kategori --</option>
                                @foreach($kategori as $cat)
                                    <option value="{{ $cat->id }}" {{ (old('kategori_item_id', $itemEdit->kategori_item_id ?? '') == $cat->id) ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                           
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <div class="bg-secondary text-primary rounded-lg p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Input Foto Barang --}}
                <div>
                    <label class="block text-sm font-semibold text-secondary mb-2">Foto Barang <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-white hover:border-primary transition group overflow-hidden relative">
                       
                        {{-- Container untuk Icon & Text (Disembunyikan jika ada gambar) --}}
                        <div id="placeholder-content" class="flex flex-col items-center justify-center pt-5 pb-6 {{ ($isEdit && $itemEdit->foto) ? 'hidden' : '' }}">
                            <svg class="w-8 h-8 mb-2 text-gray-400 group-hover:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm text-gray-500 group-hover:text-gray-700"><span class="font-semibold text-secondary">Klik upload</span> atau drag & drop</p>
                            <p class="text-xs text-gray-400 mt-1">JPEG, PNG, JPG (MAX. 2MB)</p>
                        </div>


                        {{-- Image Preview Tag --}}
                        <img id="previewItemImage"
                             src="{{ ($isEdit && $itemEdit->foto) ? asset('storage/item_photo/'.$itemEdit->foto) : '#' }}"
                             alt="Preview"
                             class="w-full h-full object-cover {{ ($isEdit && $itemEdit->foto) ? '' : 'hidden' }}">


                        <input id="dropzone-file" type="file" name="foto" class="hidden" accept="image/*" />
                    </label>
                    @error('foto')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


            </div>


            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="flex-1 py-3.5 px-6 rounded-xl bg-secondary text-primary font-bold text-base hover:bg-opacity-90 hover:shadow-lg hover:-translate-y-0.5 transition transform shadow-md" style="background-color: #003539; color: #AFEE00;">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Barang' }}
                </button>
                <a href="{{ route('item.index') }}" class="flex-1 py-3.5 px-6 rounded-xl bg-white border border-gray-200 text-gray-500 font-bold text-center hover:bg-gray-50 hover:text-gray-700 transition">
                    Batal
                </a>
            </div>


        </form>
    </div>
</div>


<script>
    const fileInput = document.getElementById('dropzone-file');
    const previewImg = document.getElementById('previewItemImage');
    const placeholder = document.getElementById('placeholder-content');


    fileInput.addEventListener('change', function() {
        const file = this.files[0];


        if (file) {
            const reader = new FileReader();


            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden'); // Sembunyikan icon saat ada gambar
            }


            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

@vite(['resources/css/app.css', 'resources/js/app.js'])


<style>
    /* Custom Colors untuk Tema Anda */
    .bg-theme-secondary { background-color: #003539; }
    .text-theme-secondary { color: #003539; }
    .bg-theme-primary { background-color: #AFEE00; }
    .text-theme-primary { color: #AFEE00; }
    .border-theme-primary { border-color: #AFEE00; }


    /* Efek Overlay pada Foto */
    .profile-upload-group:hover .upload-overlay { opacity: 1; }
    .upload-overlay {
        transition: all 0.3s ease;
        background-color: rgba(0, 53, 57, 0.7); /* Transparan Teal */
    }
</style>


<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10 px-4">
   
    <div class="bg-white w-full max-w-lg rounded-3xl shadow-[0_10px_40px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden relative">
       
        {{-- Hiasan Header (Warna Teal) --}}
        <div class="h-24 bg-theme-secondary relative">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#AFEE00 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>


        {{-- Form Content --}}
        <div class="px-8 pb-8 relative -mt-12">
           
            {{-- Action Form sesuai kode lama Anda --}}
            <form action="/dashboard/{{$usernow->username}}/edit" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Bagian Foto Profil --}}
                <div class="flex flex-col items-center mb-8">
                    <div class="relative group profile-upload-group cursor-pointer">
                        <div class="w-32 h-32 rounded-full border-4 border-white shadow-md overflow-hidden bg-gray-100 relative">
                           
                            {{-- Image Preview --}}
                            <img id="previewImage"
                                 src="{{ asset('storage/store_photo/' . $usernow->image_profile) }}"
                                 class="w-full h-full object-cover"
                                 alt="Profile Photo"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($usernow->name) }}&background=003539&color=AFEE00'">
                           
                            {{-- Overlay Icon Kamera (Muncul saat hover) --}}
                            <div class="upload-overlay absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <svg class="w-8 h-8 text-theme-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                        </div>


                        {{-- Input File Hidden --}}
                        {{-- ID 'fileupload' disesuaikan dengan script JS --}}
                        <input type="file" name="foto" id="fileupload" class="hidden" accept=".png, .jpg, .jpeg">
                       
                        {{-- Tombol Kecil Edit --}}
                        <label for="fileupload" class="absolute bottom-0 right-0 bg-theme-secondary text-theme-primary p-2 rounded-full border-2 border-white shadow-sm cursor-pointer hover:bg-opacity-90 transition transform hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </label>
                    </div>
                    <p class="text-xs text-gray-400 mt-3">Klik foto untuk mengganti</p>
                </div>


                {{-- Input Fields --}}
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-theme-secondary mb-2">Nama Anda</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                           
                            {{-- Input Name sesuai kode lama: field_nama --}}
                            <input type="text" name="field_nama"
                                   value="{{ $usernow->name }}"
                                   class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-[#003539] focus:ring-4 focus:ring-[#003539]/10 outline-none transition-all font-medium text-gray-700 placeholder-gray-400"
                                   placeholder="Nama Lengkap">
                        </div>
                    </div>
                </div>


                {{-- Action Buttons --}}
                <div class="mt-10 flex gap-4">
                    {{-- Tombol Kembali --}}
                    <a href="/ShowProfile" class="flex-1 py-3.5 rounded-xl border border-gray-200 text-gray-500 font-bold text-center hover:bg-gray-50 transition no-underline">
                        Kembali
                    </a>


                    {{-- Tombol Simpan --}}
                    <button type="submit" class="flex-1 py-3.5 rounded-xl bg-theme-secondary text-theme-primary font-bold shadow-lg hover:bg-opacity-90 hover:-translate-y-0.5 transition-all transform">
                        Simpan Perubahan
                    </button>
                </div>


            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById('fileupload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previewImage');
       
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

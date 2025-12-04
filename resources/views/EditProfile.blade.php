<div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   <div class="w-full max-w-[420px] bg-white rounded-2xl p-8 shadow-[0_8px_20px_rgba(0,0,0,0.08)] border border-gray-200 m-4">
        <div class="text-center text-[22px] font-semibold text-gray-800 mb-6">Edit Profile</div>

        <form action="/dashboard/{{$usernow->username}}/edit" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col items-center mb-5">
                <img id="previewImage" 
                     class="w-[110px] h-[110px] rounded-full bg-gray-200 object-cover border border-gray-300"
                     src="{{ asset('storage/store_photo/' . $usernow->image_profile) }}">

                <label for="fileupload" class="mt-3 text-sm cursor-pointer text-[#4a73ff] hover:text-blue-700 transition font-medium">
                    Ganti Foto
                </label>
                <input type="file" name="foto" id="fileupload" class="hidden" accept=".png, .jpg, .jpeg" onchange="previewFoto()">
            </div>

            <div class="mt-4">
                <label class="block text-sm text-gray-600 mb-2">Nama Anda</label>
                <input type="text" name="field_nama" 
                       class="w-full p-3 border border-gray-300 rounded-xl text-[15px] outline-none transition focus:border-[#4a73ff] focus:ring-2 focus:ring-[#4a73ff]/20" 
                       value="{{ $usernow->name }}">
            </div>

            <button type="submit" 
                    class="w-full mt-6 py-3.5 bg-[#4a73ff] text-white rounded-xl text-base font-semibold hover:bg-[#3c5ed8] transition shadow-md hover:shadow-lg">
                Simpan Perubahan
            </button>
        </form>

        <button onclick="window.location.href='dashboard'" 
                class="w-full mt-3 py-3.5 bg-gray-100 text-gray-700 rounded-xl text-base font-semibold hover:bg-gray-200 transition">
            Kembali
        </button>
    </div>

    <script>
        function previewFoto() {
            const file = document.getElementById('fileupload').files[0];
            const preview = document.getElementById('previewImage');
            const reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>
</div>

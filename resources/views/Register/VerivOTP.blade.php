<div>
    <!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi OTP - FreshLog</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#AFEE00',   /* Lime Fresh */
                        secondary: '#003539', /* Deep Teal */
                        danger: '#F87171',    /* Soft Red */
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full font-sans antialiased text-slate-800">

    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-6">
            <h1 class="text-3xl font-bold text-secondary">
                FreshLog 
            </h1>
            <h2 class="mt-4 text-2xl font-bold leading-9 tracking-tight text-secondary">
                Verifikasi Kode OTP
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Masukkan kode 6 digit yang kami kirim ke email Anda. <br>Kode berlaku 5 menit.
            </p>
        </div>

        <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-[450px]">
            <div class="bg-white px-6 py-10 shadow-xl shadow-secondary/5 rounded-2xl sm:px-10 border border-slate-100">
                
                {{-- 🟢 Logic Blade: Notifikasi Sukses --}}
                @if(session('success'))
                    <div class="mb-6 rounded-lg bg-lime-50 p-4 border border-lime-200 flex items-center">
                        <span class="text-xl mr-3">✅</span>
                        <p class="text-sm font-medium text-lime-800">{{ session('success') }}</p>
                    </div>
                @endif

                {{-- 🔴 Logic Blade: Notifikasi Error / Validation --}}
                @if(session('error') || $errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 p-4 border border-red-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Verifikasi Gagal</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul role="list" class="list-disc pl-5 space-y-1">
                                        @if(session('error')) 
                                            <li>{{ session('error') }}</li> 
                                        @endif
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('otp.verify') }}" method="POST" autocomplete="off">
                    @csrf
                    
                    <div>
                        <label for="otp" class="block text-sm font-medium leading-6 text-secondary">
                            Kode OTP
                        </label>
                        <div class="mt-2">
                            <input 
                                id="otp" 
                                name="otp" 
                                type="text" 
                                inputmode="numeric" 
                                maxlength="6" 
                                pattern="\d{6}" 
                                required 
                                value="{{ old('otp') }}"
                                placeholder="123456"
                                autofocus
                                class="block w-full rounded-xl border-0 py-4 text-secondary text-center text-2xl tracking-[0.5em] font-bold shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-300 placeholder:tracking-normal placeholder:font-normal focus:ring-2 focus:ring-inset focus:ring-primary sm:text-lg sm:leading-6 transition-all"
                            >
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-xl bg-secondary px-3 py-3.5 text-sm font-semibold leading-6 text-primary shadow-sm hover:bg-[#002528] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                            Verifikasi
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm">
                    <p class="text-slate-500">
                        Jika kamu tidak menerima email, periksa folder SPAM atau
                        <button type="button" class="font-semibold text-secondary hover:text-teal-700 transition-colors underline decoration-dotted">
                            Kirim Ulang OTP
                        </button>
                    </p>
                </div>
            </div>

            <p class="mt-10 text-center text-sm text-slate-500 pb-10">
                Ingat: halaman ini hanya bisa diakses setelah login awal.<br>
                Jika kamu belum masuk, 
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-danger hover:text-red-600 transition-colors">
                    kembali ke login
                </a>.
            </p>
        </div>
    </div>

</body>
</html>
</div>
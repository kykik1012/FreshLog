<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Verifikasi OTP</title>
    <!-- Tambahkan CSS/Bootstrap jika perlu -->
    <style>
        body{ font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:#f6f7fb; padding:40px; }
        .card{ background:white; max-width:480px; margin:40px auto; padding:28px; border-radius:12px; box-shadow:0 6px 20px rgba(20,20,40,0.06); }
        h2{ margin:0 0 8px 0; font-size:20px; }
        p.lead{ margin:0 0 16px 0; color:#555; }
        .input-group{ margin: 12px 0; }
        input[type="text"]{ width:100%; padding:10px 12px; border:1px solid #ddd; border-radius:6px; font-size:16px; }
        .btn{ padding:10px 14px; border-radius:8px; border:none; cursor:pointer; font-weight:600; }
        .btn-primary{ background:#2563eb; color:white; }
        .btn-secondary{ background:#e5e7eb; color:#111; }
        .text-error{ color:#b91c1c; margin-top:8px; }
        .small{ font-size:13px; color:#666; margin-top:8px; }
        .otp-box{ font-family:monospace; letter-spacing:6px; background:#f3f4f6; padding:10px 14px; display:inline-block; border-radius:6px; }
        .actions{ display:flex; gap:10px; margin-top:14px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Verifikasi Kode OTP</h2>
        <p class="lead">Masukkan kode 6 digit yang kami kirim ke alamat email akun Anda. Kode berlaku 5 menit.</p>

        {{-- Notifikasi umum --}}
        @if(session('success'))
            <div style="color:green; margin-bottom:10px;">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="text-error">{{ session('error') }}</div>
        @endif

        {{-- Validasi Input --}}
        @if ($errors->any())
            <div class="text-error">
                <ul style="margin:8px 0 12px 18px; padding:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('otp.verify') }}" method="POST" autocomplete="off">
            @csrf
            <div class="input-group">
                <label for="otp">Kode OTP</label>
                <input id="otp" name="otp" type="text" inputmode="numeric" maxlength="6" pattern="\d{6}" placeholder="Contoh: 123456" required value="{{ old('otp') }}">
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Verifikasi</button>
            </div>

            <p class="small">Jika kamu tidak menerima email, periksa folder SPAM atau klik "Kirim Ulang OTP".</p>
        </form>

        <hr style="margin:18px 0;">
        <p class="small">Ingat: halaman ini hanya bisa diakses setelah proses login awal. Jika kamu belum masuk, <a href="{{ route('login') }}">kembali ke login</a>.</p>
    </div>
</body>
</html>

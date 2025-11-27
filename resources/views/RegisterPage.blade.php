<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
        <style>
        html, body {
            height: 100%;
            overflow: hidden;
            margin: 0;
            font-family: sans-serif;
            background: #000;
        }


        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .background {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, #ff7a18, transparent 60%),
                        radial-gradient(circle at 80% 80%, #18b0ff, transparent 60%);
            filter: blur(100px);
            opacity: 0.25;
        }


        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .wrap {
            width: 100%;
            max-width: 460px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border-radius: 30px;
            padding: 35px;
            animation: fadeUp 0.7s ease;
            text-align: center;
        }


        h2 {
            color: #fff;
            margin-bottom: 10px;
            font-size: 32px;
        }


        p {
            color: #fff;
            opacity: 0.7;
            margin-bottom: 25px;
            font-size: 14px;
        }


        h5 {
            color: #fff;
            text-align: left;
            margin-left: 5%;
            margin-bottom:3px;
            margin-top:1px;
            font-size: 10px;
        }


        input {
            width: 90%;
            padding: 14px;
            margin-bottom: 15px;
            border-radius: 12px;
            border: none;
            outline: none;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-size: 15px;
        }


        .btn-register {
            width: 90%;
            padding: 12px;
            border-radius: 12px;
            border: none;
            background: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }


        .btn-register:hover {
            background: #dcdcdc;
        }


        .btn-back {
            width: 90%;
            padding: 12px;
            border-radius: 12px;
            background: transparent;
            font-size: 15px;
            border: 2px solid rgba(255, 255, 255, 0.25);
            color: white;
            margin-top: 10px;
            cursor: pointer;
        }


        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
        }


        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="background"></div>

    <div class="container">
        <div class="wrap">

            <h2>Register</h2>
            <p>Yuk mulai buat akunmu sekarang</p>

            <form action="{{ route('register.validate') }}" method="POST">
                @csrf

                <h5>Nama lengkap</h5>
                <input type="text" name="namereg" placeholder="Nama Lengkap Anda" value="{{ old('namereg') }}" required>
                @error('namereg') <span class="error-text">{{ $message }}</span> @enderror

                <h5>Username</h5>
                <input type="text" name="usernamereg" placeholder="Username Harus Unik" value="{{ old('usernamereg') }}" autocomplete="off" required>
                @error('usernamereg') <span class="error-text">{{ $message }}</span> @enderror
               
                <h5>Email</h5>
                <input type="email" name="emailreg" placeholder="Pastikan Email Aktif" value="{{ old('emailreg') }}" required>
                @error('emailreg') <span class="error-text">{{ $message }}</span> @enderror
               
                <h5>Password</h5>
                <input type="password" name="passwordreg" placeholder="Minimal 8 karakter" autocomplete="new-password" required>
                @error('passwordreg') <span class="error-text">{{ $message }}</span> @enderror
               
                <h5>Konfirmasi Password</h5>
                <input type="password" name="conpasswordreg" placeholder="Ketik Ulang Password" required>
                @error('conpasswordreg') <span class="error-text">{{ $message }}</span> @enderror
               
                <button type="submit" class="btn-register">Register</button>
            </form>

            <button class="btn-back" onclick="window.location.href='{{ route('login') }}'">Back to Login</button>

        </div>
    </div>
</body>
</html>
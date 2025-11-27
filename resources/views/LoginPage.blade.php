<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            z-index: -1;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrap {
            width: 100%;
            max-width: 400px; /* Sedikit diperkecil agar lebih proporsional */
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border-radius: 30px;
            padding: 35px;
            animation: fadeUp 0.7s ease;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        h2 {
            color: #fff;
            margin-bottom: 10px;
            font-size: 32px;
            margin-top: 0;
        }

        p {
            color: #fff;
            opacity: 0.7;
            margin-bottom: 25px;
            font-size: 14px;
        }

        a {
            color: #fff;
            font-size: 12px;
            text-decoration: none;
            margin-top: 15px;
            display: inline-block;
            opacity: 0.8;
        }
        
        a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        h5 {
            color: #fff;
            text-align: left;
            margin-left: 2%;
            margin-bottom: 5px;
            margin-top: 10px;
            font-size: 12px;
            opacity: 0.9;
        }

        input {
            width: 90%;
            padding: 14px;
            margin-bottom: 5px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.1);
            outline: none;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-login{
            width: 100%; /* Full width agar rapi */
            padding: 12px;
            border-radius: 12px;
            border: none;
            background: white;
            color: #000;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #e0e0e0;
            transform: scale(1.02);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            background: transparent;
            font-size: 15px;
            border: 2px solid rgba(255, 255, 255, 0.25);
            color: white;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
        }

        /* Style pesan error agar menyatu dengan tema */
        .error-message {
            background: rgba(239, 68, 68, 0.25);
            border: 1px solid rgba(239, 68, 68, 0.5);
            color: #fca5a5;
            padding: 10px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: left;
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

                <h2>Login</h2>
                <p>Heyy Selamat datang</p>
                
                @if(session('error'))
                    <div class="error-message">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.validate') }}" method="POST">
                    @csrf

                    <h5>Username</h5>
                    <input type="text" name="usernamelgn" placeholder="Masukkan Username" autocomplete="off" required>
                   
                    <h5>Password</h5>
                    <input type="password" name="passwordlgn" placeholder="Masukkan Password" autocomplete="current-password" required>
                   
                    <button type="submit" class="btn-login">Login</button>
                   
                </form>

                <a href="#">---------- Lupa Password? ----------</a>
                
                <button class="btn-register" onclick="window.location.href='/register'">Register</button>
                   
            </div>
        </div>

</body>
</html>
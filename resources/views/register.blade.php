<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | AGATHA SPACE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold: #C5A059;
            --espresso: #2A1E17;
            --linen: #FDFBF7;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            background: linear-gradient(rgba(42,30,23,0.8), rgba(42,30,23,0.8)),
            url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            align-items: center;
            justify-content: center;
        }

        .register-box {
            background: var(--white);
            width: 420px;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            text-align: center;
        }

        .register-box h1 {
            font-family: 'Allura', cursive;
            font-size: 60px;
            color: var(--gold);
            margin-bottom: -10px;
        }

        .register-box h2 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 30px;
            color: var(--espresso);
            letter-spacing: 2px;
        }

        .input-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .input-group label {
            font-size: 13px;
            font-weight: 600;
            color: var(--espresso);
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-top: 5px;
            outline: none;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: var(--gold);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: none;
            background: var(--espresso);
            color: var(--gold);
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: #3d2d23;
        }

        .btn-login {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            font-size: 14px;
            color: var(--espresso);
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h1>Agatha</h1>
    <h2>CREATE ACCOUNT</h2>

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group">
            <label>Nama</label>
            <input type="text" name="name" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="input-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn-register">Register</button>
    </form>

    <a href="{{ route('login') }}" class="btn-login">
        Sudah punya akun? Login
    </a>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | AGATHA SPACE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold: #C5A059;
            --gold-light: #D4B87A;
            --espresso: #2A1E17;
            --espresso-mid: #3d2d23;
            --linen: #FDFBF7;
            --cream: #F3EDE3;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                linear-gradient(rgba(42,30,23,0.78), rgba(42,30,23,0.78)),
                url('{{asset("adminlte/dist/img/tempat.jpeg")}}');
            background-size: cover;
            background-position: center;
        }

        .card {
            background: var(--linen);
            width: 100%;
            max-width: 420px;
            margin: 20px;
            border-radius: 18px;
            box-shadow: 0 28px 64px rgba(0,0,0,0.4);
            overflow: hidden;
        }

        .card-top-bar {
            height: 4px;
            background: linear-gradient(90deg, var(--espresso), var(--gold), var(--espresso));
        }

        .card-header {
            text-align: center;
            padding: 36px 40px 0;
        }

        .card-header h1 {
            font-family: 'Allura', cursive;
            font-size: 66px;
            color: var(--gold);
            line-height: 1;
        }

        .card-header .tagline {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: var(--espresso);
            opacity: 0.45;
            margin-top: 2px;
        }

        .ornament {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 40px 24px;
        }

        .ornament::before,
        .ornament::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gold);
            opacity: 0.3;
        }

        .ornament-diamond {
            width: 7px;
            height: 7px;
            background: var(--gold);
            transform: rotate(45deg);
            opacity: 0.6;
            flex-shrink: 0;
        }

        .card-body {
            padding: 0 40px 36px;
        }

        .error {
            font-size: 13px;
            color: #9b3a3a;
            background: #fdf0f0;
            border-left: 3px solid #c97070;
            padding: 10px 14px;
            border-radius: 0 6px 6px 0;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--espresso);
            opacity: 0.55;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
            opacity: 0.5;
            pointer-events: none;
        }

        .input-group input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            background: var(--cream);
            border: 1px solid rgba(197,160,89,0.25);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 300;
            color: var(--espresso);
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }

        .input-group input::placeholder {
            color: rgba(42,30,23,0.28);
        }

        .input-group input:focus {
            border-color: var(--gold);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(197,160,89,0.12);
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            margin-top: 10px;
            background: var(--espresso);
            color: var(--gold-light);
            border: none;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
        }

        .btn-login:hover {
            background: var(--espresso-mid);
            box-shadow: 0 6px 20px rgba(42,30,23,0.2);
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: transparent;
            color: var(--espresso);
            border: 1.5px solid rgba(42,30,23,0.22);
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-register:hover {
            background: var(--espresso);
            color: var(--gold-light);
            border-color: var(--espresso);
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-top-bar"></div>

    <div class="card-header">
        <h1>Agatha</h1>
        <div class="tagline">Space</div>
    </div>

    <div class="ornament">
        <div class="ornament-diamond"></div>
    </div>

    <div class="card-body">

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="input-group">
                <label>Email</label>
                <div class="input-wrap">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 7 10-7"/>
                    </svg>
                    <input type="email" name="email" placeholder="alamat@email.com" required>
                </div>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-wrap">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Masuk</button>

            <a href="{{ route('register') }}" style="text-decoration: none;">
                <button type="button" class="btn-register">Buat Akun</button>
            </a>

        </form>

    </div>
</div>

</body>
</html>
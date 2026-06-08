<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'AGATHA SPACE | Premium Experience')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('adminlte/dist/img/logo agatha.jpg') }}">

    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        /* ── VARIABLES ── */
        :root {
            --gold:     #C5A059;
            --espresso: #2A1E17;
            --linen:    #FDFBF7;
            --white:    #FFFFFF;
            --taupe:    #8D7B68;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
        body { background: var(--linen); color: var(--espresso); }


        /* ════════════════════════════
           NAVBAR
        ════════════════════════════ */
        .navbar {
            background: var(--white);
            padding: 15px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .nav-left  { display: flex; align-items: center; gap: 40px; }
        .logo-box  { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 20px; letter-spacing: 1px; color: var(--espresso); }
        .logo-box img { width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--gold); }

        .nav-links { list-style: none; display: flex; gap: 25px; }
        .nav-links a { text-decoration: none; color: var(--espresso); font-weight: 700; font-size: 13px; text-transform: uppercase; transition: 0.3s; }
        .nav-links a:hover { color: var(--gold); }

        .nav-right { display: flex; align-items: center; gap: 20px; margin-right: 40px; }

        .btn-login,
        .btn-logout {
            background: var(--espresso);
            color: var(--gold);
            padding: 9px 26px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            border: 1px solid var(--espresso);
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-login:hover,
        .btn-logout:hover {
            background: transparent;
            color: var(--espresso);
        }

        .user-name { margin-right: 8px; font-weight: 600; color: var(--espresso); font-size: 13px; }

        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }
        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: var(--espresso);
            border-radius: 3px;
            transition: all 0.3s ease-in-out;
        }

        /* ════════════════════════════
           HERO BANNER
        ════════════════════════════ */
        .hero-banner {
            position: relative;
            width: 100%; height: 550px;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 0 8%;
            color: white;
        }

        .hero-img {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .hero-banner::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(to right, rgba(42,30,23,0.6), rgba(42,30,23,0.2));
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 600px;
        }

        .hero-content h1 { font-family: 'Allura', cursive; font-size: 85px; color: var(--gold); margin-bottom: -10px; line-height: 1; }
        .hero-content h2 { font-size: 45px; font-weight: 800; text-transform: uppercase; line-height: 1; margin-bottom: 15px; letter-spacing: -1px; }
        .hero-content p  { font-size: 16px; opacity: 0.9; margin-bottom: 25px; font-weight: 300; line-height: 1.6; }


        /* ════════════════════════════
           NEWS SECTION
        ════════════════════════════ */
        .news { padding: 80px 8%; background: var(--linen); }

        .section-header { text-align: center; margin-bottom: 50px; }
        .section-header h2 { font-weight: 800; font-size: 28px; text-transform: uppercase; letter-spacing: 2px; }
        .section-header .line { width: 60px; height: 3px; background: var(--gold); margin: 15px auto; }

        .news-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }

        .news-card { background: var(--white); border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03); transition: 0.4s; border-bottom: 3px solid transparent; }
        .news-card:hover { transform: translateY(-10px); border-bottom: 3px solid var(--gold); box-shadow: 0 20px 40px rgba(0,0,0,0.07); }
        .news-card img { width: 100%; height: 250px; object-fit: cover; }
        .news-card .content { padding: 30px; }
        .news-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 10px; color: var(--espresso); }
        .news-card p  { font-size: 14px; color: var(--taupe); margin-bottom: 20px; line-height: 1.6; }
        .btn-card { color: var(--gold); text-decoration: none; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }


        /* ════════════════════════════
           FOOTER
        ════════════════════════════ */
        .main-footer {
            background: #150d0a; /* Dark espresso brown */
            padding: 50px 8% 30px;
            color: var(--white);
            display: flex;
            justify-content: flex-start;
        }

        .footer-container {
            width: 100%;
            max-width: 800px;
        }

        .footer-title {
            color: var(--gold);
            margin-bottom: 8px;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .footer-subtext {
            color: #d1c1b1;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
            font-weight: 400;
        }

        /* social icons */
        .social-row { display: flex; gap: 12px; margin-bottom: 30px; }

        .social-btn {
            width: 42px; height: 42px;
            border-radius: 50%;
            border: 1px solid rgba(197,160,89, 0.5);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold);
            text-decoration: none;
            transition: 0.3s;
        }
        .social-btn:hover {
            background: var(--gold);
            color: #150d0a;
            transform: translateY(-2px);
        }

        .map-container {
            margin-bottom: 25px;
            width: 100%;
        }

        .quote-box {
            border: 1px solid rgba(197,160,89, 0.4);
            padding: 15px 20px;
            border-radius: 6px;
            color: var(--gold);
            font-size: 13.5px;
            font-style: italic;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* copyright bar */
        .copyright {
            background: #0f0907;
            padding: 15px 8%;
            color: #b09e8d;
            font-size: 12px;
            letter-spacing: 1px;
            text-align: left;
        }

        /* floating order button */
        .order-float {
            position: fixed;
            bottom: 28px; right: 28px;
            background: var(--espresso);
            color: var(--gold);
            padding: 14px 26px;
            border-radius: 40px;
            font-weight: 800;
            font-size: 13px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 9px;
            z-index: 100;
            transition: 0.3s;
            letter-spacing: 0.5px;
        }
        .order-float:hover { transform: scale(1.05); background: #3d2d23; color: var(--gold); }
        .order-float svg { flex-shrink: 0; }


        /* ════════════════════════════
           RESPONSIVE
        ════════════════════════════ */
        @media (max-width: 768px) {
            .navbar { padding: 15px 20px; }
            .hamburger { display: flex; order: 3; }
            .nav-right { order: 2; margin-right: 15px; }
            .nav-left { order: 1; }
            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: var(--white);
                flex-direction: column;
                align-items: center;
                gap: 15px;
                padding: 20px 0;
                box-shadow: 0 5px 10px rgba(0,0,0,0.1);
                display: none;
            }
            .nav-links.active {
                display: flex;
            }
            .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
            .hamburger.active span:nth-child(2) { opacity: 0; }
            .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }
            .hero-content h1 { font-size: 60px; }
            .hero-content h2 { font-size: 30px; }
        }

    </style>
</head>

<body>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
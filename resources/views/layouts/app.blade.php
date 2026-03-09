<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'AGATHA SPACE | Premium Experience')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --gold: #C5A059;
            --espresso: #2A1E17;
            --linen: #FDFBF7;
            --white: #FFFFFF;
            --taupe: #8D7B68;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
        body { background: var(--linen); color: var(--espresso); }

        .navbar {
    background: var(--white);
    padding: 15px 60px;   /* jarak isi ke kiri-kanan */
    display: flex;
    align-items: center;
    justify-content: space-between;

    position: fixed;
    top: 0;
    left: 0;
    width: 100%;

    z-index: 1000;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

        .nav-left { display: flex; align-items: center; gap: 40px; }
        .logo-box { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 20px; letter-spacing: 1px; color: var(--espresso); }
        .logo-box img { width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--gold); }

        .nav-links { list-style: none; display: flex; gap: 25px; }
        .nav-links a { text-decoration: none; color: var(--espresso); font-weight: 700; font-size: 13px; text-transform: uppercase; transition: 0.3s; }
        .nav-links a:hover { color: var(--gold); }

        .nav-right { display: flex; align-items: center; gap: 20px; margin-right: 40px; }
        .btn-login { background: var(--espresso); color: var(--gold); padding: 9px 30px; border-radius: 30px; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.3s; border: 1px solid var(--espresso); }
        .btn-login:hover { background: transparent; color: var(--espresso); }

        .hero-banner {
            width: 100%;
            height: 550px;  
            background: linear-gradient(to right, rgba(42, 30, 23, 0.8), rgba(42, 30, 23, 0.3)),
            url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding: 0 8%;
            color: var(--white);
        }

        .hero-content { max-width: 600px; }
        .hero-content h1 { font-family: 'Allura', cursive; font-size: 85px; color: var(--gold); margin-bottom: -10px; line-height: 1; }
        .hero-content h2 { font-size: 45px; font-weight: 800; text-transform: uppercase; line-height: 1; margin-bottom: 15px; letter-spacing: -1px; }
        .hero-content p { font-size: 16px; opacity: 0.9; margin-bottom: 25px; font-weight: 300; line-height: 1.6; }

        .news { padding: 80px 8%; background: var(--linen); }

        .section-header { text-align: center; margin-bottom: 50px; }
        .section-header h2 { font-weight: 800; font-size: 28px; text-transform: uppercase; letter-spacing: 2px; }
        .section-header .line { width: 60px; height: 3px; background: var(--gold); margin: 15px auto; }

        .news-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .news-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            transition: 0.4s;
            border-bottom: 3px solid transparent;
        }

        .news-card:hover {
            transform: translateY(-10px);
            border-bottom: 3px solid var(--gold);
            box-shadow: 0 20px 40px rgba(0,0,0,0.07);
        }

        .news-card img { width: 100%; height: 250px; object-fit: cover; }
        .news-card .content { padding: 30px; }
        .news-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 10px; color: var(--espresso); }
        .news-card p { font-size: 14px; color: var(--taupe); margin-bottom: 20px; line-height: 1.6; }
        .btn-card { color: var(--gold); text-decoration: none; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; }

        footer {
            background: var(--espresso);
            padding: 60px 8% 40px;
            color: var(--white);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }

        footer h4 { color: var(--gold); margin-bottom: 20px; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; }
        footer ul { list-style: none; }
        footer ul li { margin-bottom: 10px; }
        footer ul li a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 14px; transition: 0.3s; }
        footer ul li a:hover { color: var(--gold); padding-left: 5px; }

        .copyright {
            background: #1a130e;
            text-align: center;
            padding: 20px;
            color: #555;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .order-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--espresso);
            color: var(--gold);
            padding: 15px 30px;
            border-radius: 40px;
            font-weight: 800;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 100;
            transition: 0.3s;
        }

        .order-float:hover { transform: scale(1.05); background: #3d2d23; }

        @media (max-width: 768px) {
            .navbar { padding: 15px 20px; }
            .nav-links { display: none; }
            .hero-content h1 { font-size: 60px; }
            .hero-content h2 { font-size: 30px; }
        }

        .btn-login,
.btn-logout {
    background: #4b2e2e;
    color: white;
    padding: 8px 18px;
    border-radius: 20px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    font-weight: 500;
    transition: 0.3s;
}

.btn-login:hover,
.btn-logout:hover {
    background: #2e1b1b;
}

.user-name {
    margin-right: 10px;
    font-weight: 600;
    color: #4b2e2e;
}
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<body>



@yield('content')



</body>
</html>
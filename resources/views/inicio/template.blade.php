<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FaceBol - @yield('title', '¡Hazlo Diferente!')</title>
    
    {{-- @include('inicio.partes.meta') --}}
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    
    <style>
        :root {
            --primary: #1a3a6b;
            --accent: #f5a623;
            --accent2: #e06b2d;
            --blue-light: #2e6bc4;
            --text-dark: #1a2340;
            --text-muted: #555;
            --card-bg: #fff;
            --section-bg: #f4f7fc;
            --text-white: #ffffff;
            --yellow-light: #f5a623;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, h4, h5, .navbar-brand {
            font-family: 'Poppins', sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, #0d1f45 0%, #1a3a6b 50%, #1e4fa0 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
            padding: 12px 0;
        }
        .navbar-brand img {
            height: 44px;
        }
        .nav-link {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--text-white) !important;
            padding: 6px 16px !important;
            transition: color .2s;
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 16px;
            width: calc(100% - 32px);
            height: 2px;
            background-color: var(--text-white);
            transition: background-color .3s ease;
        }
        .nav-link:hover::after,
        .nav-link.active::after {
            background-color: var(--yellow-light);
        }
        .nav-link:hover,
        .nav-link.active { color: var(--yellow-light) !important; }

        .btn-outline-register {
            background: transparent;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            border-radius: 25px;
            padding: 10px 28px;
            border: 2px solid rgba(255,255,255,.6);
            transition: all .2s;
        }
        .btn-outline-register:hover {
            background: var(--primary);
            color: #ffffff;
        }
        .btn-login {
            background: var(--blue-light);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            border-radius: 25px;
            padding: 10px 28px;
            border: none;
            transition: all .2s;
        }
        .btn-login:hover {
            background: var(--primary);
            color: #ffffff;
        }

        /* HERO CAROUSEL */
        #heroCarousel {
            background: linear-gradient(135deg, #0d1f45 0%, #1a3a6b 50%, #1e4fa0 100%);
            min-height: 420px;
            position: relative;
            overflow: hidden;
        }
        .hero-slide {
            padding: 60px 0 50px;
        }
        .hero-promo-card {
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0,0,0,.25);
            max-width: 240px;
            position: relative;
        }
        .hero-promo-card .badge-30 {
            position: absolute;
            top: -14px; left: 14px;
            background: var(--accent);
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            padding: 6px 14px;
            border-radius: 50px;
        }
        .hero-promo-card .badge-20 {
            position: absolute;
            top: -14px; right: 14px;
            background: #e53935;
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            padding: 6px 14px;
            border-radius: 50px;
        }
        .promo-label {
            background: linear-gradient(90deg, #e53935, #ff7043);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            padding: 8px 0;
            border-radius: 8px;
            margin-top: 12px;
        }
        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
        }
        .hero-title .highlight { color: var(--accent); }
        .hero-sub {
            color: #c8d9f5;
            font-size: 0.97rem;
            margin: 14px 0 10px;
        }
        .btn-conocenos {
            background: var(--blue-light);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            border-radius: 25px;
            padding: 10px 28px;
            border: none;
        }
        .btn-beneficios {
            background: transparent;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            border-radius: 25px;
            padding: 10px 28px;
            border: 2px solid rgba(255,255,255,.6);
        }

        /* FEATURES */
        .features-section {
            padding: 55px 0 40px;
            background: #fff;
        }
        .feature-card {
            background: #fff;
            border-radius: 16px;
            padding: 30px 24px;
            text-align: center;
            box-shadow: 0 4px 24px rgba(30,70,150,.09);
            height: 100%;
            transition: transform .25s;
        }
        .feature-card:hover {
            transform: translateY(-6px);
        }
        .feature-icon {
            width: 62px; height: 62px;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, #e8f0fe, #c5d8ff);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem;
            color: var(--blue-light);
        }
        .feature-card h5 {
            color: var(--blue-light);
            font-weight: 700;
        }

        /* PARTNERS */
        .partners-section {
            padding: 45px 0;
            background: var(--section-bg);
        }
        .partners-section h2 {
            color: var(--primary);
            font-weight: 800;
            text-align: center;
            margin-bottom: 28px;
        }
        .partner-logo {
            background: #fff;
            border-radius: 12px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 70px;
            box-shadow: 0 2px 10px rgba(0,0,0,.07);
            transition: transform .2s;
        }
        .partner-logo:hover {
            transform: scale(1.06);
        }

        /* CARD CTA */
        .card-cta-section {
            background: linear-gradient(135deg, #0d1f45 0%, #1a3a6b 55%, #1e4fa0 100%);
            padding: 60px 0;
            position: relative;
        }
        .cta-box {
            background: linear-gradient(135deg, #e040a0 0%, #7b2fff 100%);
            border-radius: 18px;
            padding: 24px 30px 20px;
            display: inline-block;
            margin-bottom: 24px;
        }
        .cta-box h3 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            margin: 0;
        }
        .cta-check {
            color: #c8d9f5;
            font-size: .95rem;
            margin-bottom: 8px;
        }
        .cta-check i { color: var(--accent); margin-right: 8px; }
        .btn-solicitar {
            background: var(--blue-light);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            border-radius: 25px;
            padding: 12px 36px;
            border: none;
        }

        /* MISSION */
        .mission-section {
            padding: 60px 0;
            background: #fff;
        }
        .badge-mission, .badge-vision {
            display: inline-block;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            padding: 8px 36px;
            border-radius: 50px;
            margin-bottom: 16px;
        }
        .badge-mission { background: var(--accent); }
        .badge-vision { background: var(--primary); }
        .mv-box {
            border: 2px solid var(--accent);
            border-radius: 16px;
            padding: 24px 28px;
            text-align: center;
            margin-bottom: 20px;
        }
        .mv-box.vision-box { border-color: var(--primary); }

        /* FOOTER */
        footer {
            background: var(--primary);
            padding: 40px 0 20px;
            color: #c8d9f5;
        }
        footer .brand-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.3rem;
            color: #fff;
        }
        .footer-divider {
            border-top: 1px solid rgba(255,255,255,.12);
            margin: 20px 0 14px;
        }
        .footer-copy {
            text-align: center;
            font-size: .8rem;
            color: #8aabdf;
        }
        .social-link {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 1.6rem; }
            .cta-box h3 { font-size: 1.2rem; }
        }
    </style>
    
    @stack('styles')
</head>
</head>
<body>

    <!-- NAVBAR ESTATICA -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">FACEBOL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Beneficios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Empresas</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="#" class="btn-login">Ingresar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ÁREA DE CONTENIDO -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER ESTATICO -->
    <footer>
        <div class="container">
            <p class="mb-0">&copy; 2024 FaceBol - Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://jsdelivr.net"></script>
</body>
</html>
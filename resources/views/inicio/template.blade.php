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
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @stack('styles')
</head>
<body>

<!-- HERO SECTION CON IMAGEN DE FONDO -->
<div class="hero-section">
    <!-- NAVBAR - Transparente inicialmente -->
    <nav class="navbar navbar-expand-lg" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagen/institucion/' . ($institucion->imagen ?? 'facebol.png')) }}" alt="FaceBol">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Actividades</a>
                    </li>
                </ul>
                <div class="d-flex gap-2">

                        <a href="#" class="btn btn-outline-register" data-bs-toggle="modal" data-bs-target="#ms-account-modal">Registrarse</a>
                        <a href="#" class="btn btn-login" data-bs-toggle="modal" data-bs-target="#ms-account-modal">Iniciar Sesión</a>
                    
                </div>
            </div>
        </div>
    </nav>
    
    <!-- CAROUSEL -->
    <div class="hero-carousel-container">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators" style="bottom: 30px;">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                @yield('carousel-content')
            </div>
        </div>
    </div>
</div>

<!-- CONTENIDO PRINCIPAL -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('imagen/institucion/' . ($institucion->imagen ?? 'facebol.png')) }}" alt="Logo FaceBol" style="height: 44px;">
                </div>
                <div class="d-flex align-items-start gap-2 mb-2">
                    <i class="fas fa-map-marker-alt footer-icon mt-1"></i>
                    <span>{{ $institucion->direccion ?? 'El Alto, Zona Ballivian, Av. Chacaltaya #50' }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fas fa-envelope footer-icon"></i>
                    <a href="mailto:{{ $institucion->email ?? 'faceboisrl@gmail.com' }}">{{ $institucion->email ?? 'faceboisrl@gmail.com' }}</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fab fa-whatsapp footer-icon"></i>
                    <a href="https://wa.me/591{{ $institucion->celular ?? '76266570' }}">{{ $institucion->celular ?? '76266570' }}</a>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-4">
                <div class="social-link">
                    <i class="fab fa-tiktok" style="color:var(--accent);"></i>
                    <span>TikTok</span>
                </div>
                <div class="social-link">
                    <i class="fab fa-facebook" style="color:#4267B2;"></i>
                    <span>Facebook</span>
                </div>
                <div class="social-link">
                    <i class="fab fa-instagram" style="color:#E4405F;"></i>
                    <span>Instagram</span>
                </div>
            </div>
        </div>
        <div class="footer-divider"></div>
        <p class="footer-copy">Copyright © {{ date('Y') }} FaceBol S.R.L. Todos los derechos reservados.</p>
    </div>
</footer>

<!-- MODAL LOGIN -->
{{-- @include('inicio.partes.modal') --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para el cambio del navbar al hacer scroll -->
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

@stack('scripts')

</body>
</html>
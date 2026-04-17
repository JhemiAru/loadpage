<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FaceBol SRL</title>        
    <link rel="shortcut icon" href="imagen/institucion/favicon_facebol.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @stack('styles')
</head>
<body>

<div class="hero-section {{ request()->routeIs('inicio') ? '' : 'mini-hero' }}">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagen/institucion/' . ($institucion->imagen ?? 'facebol.png')) }}" alt="FaceBol" width="150px" height="80px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav mx-auto gap-1">
                    <!-- Inicio -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}" 
                           href="{{ route('inicio') }}">
                           Inicio
                        </a>
                    </li>
                    
                    <!-- Empresas -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('empresa*') || request()->routeIs('categoria*') || request()->routeIs('ciudad*') || request()->routeIs('comision*') ? 'active' : '' }}" 
                           href="#" 
                           data-bs-toggle="dropdown">
                           Empresas
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Categorías -->
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Categorías</a>
                                <ul class="dropdown-menu">
                                    @foreach($categorias as $categoria)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('categoria', $categoria->slug) }}">
                                            {{ $categoria->nombre }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <!-- Ciudades -->
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Ciudades</a>
                                <ul class="dropdown-menu">
                                    @foreach($ciudades as $ciudad)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('ciudad', $ciudad->id) }}">
                                            {{ $ciudad->nombre }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('empresa') }}">Todas las empresas</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('comision') }}">Empresas por comisión</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Actividades -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('actividad*') ? 'active' : '' }}" 
                           href="{{ route('actividad') }}">
                           Actividades
                        </a>
                    </li>
                    
                    <!-- Noticias -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('noticia*') ? 'active' : '' }}" 
                           href="{{ route('noticia') }}">
                           Noticias
                        </a>
                    </li>
                    
                    <!-- Equipo -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('equipo*') ? 'active' : '' }}" 
                           href="{{ route('equipo') }}">
                           Nuestro Equipo
                        </a>
                    </li>
                    
                    <!-- Contacto -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contactanos*') ? 'active' : '' }}" 
                           href="{{ route('contactanos') }}">
                           Contáctanos
                        </a>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    <button href="#" class="btn btn-outline-register" data-bs-toggle="modal" data-bs-target="#ms-account-modal">Registrarse</button>
                    <button href="#" class="btn btn-login" data-bs-toggle="modal" data-bs-target="#ms-account-modal">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Carrusel -->
    @yield('hero-carousel')
</div>

<!-- CONTENIDO PRINCIPAL -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-3 d-flex justify-content-center justify-content-lg-start">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                    <img src="{{ asset('imagen/institucion/' . ($institucion->imagen ?? 'facebol.png')) }}" alt="FaceBol" style="width: 200px; height: auto;">
                </a>
            </div>

            <div class="col-lg-5">
                <div class="d-flex align-items-start gap-2 mb-2">
                    <i class="fas fa-map-marker-alt footer-icon mt-1"></i>
                    <span>{{ $institucion->direccion ?? 'El Alto, Zona Ballivian, Av. Chacaltaya #50' }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fas fa-envelope footer-icon"></i>
                    <a href="mailto:{{ $institucion->email ?? 'facebolsrl@gmail.com' }}">{{ $institucion->email ?? 'facebolsrl@gmail.com' }}</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="fab fa-whatsapp footer-icon"></i>
                    <a href="https://wa.me/591{{ $institucion->celular ?? '76266570' }}" >{{ $institucion->celular ?? '76266570' }}</a>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="d-flex flex-column align-items-lg-end">
                    <div class="social-link">
                        <i class="fab fa-tiktok footer-icon"></i>                        
                    </div>
                    <div class="social-link">
                        <i class="fab fa-facebook footer-icon"></i>                            
                    </div>
                    <div class="social-link">
                        <i class="fab fa-instagram footer-icon"></i>                            
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-divider"></div>
        <p class="footer-copy text-center">Copyright © {{ date('Y') }} FaceBol S.R.L. Todos los derechos reservados.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const navbar = document.querySelector('.navbar');
    const collapse = document.querySelector('.navbar-collapse');

    collapse.addEventListener('show.bs.collapse', () => {
        navbar.classList.add('menu-open');
    });

    collapse.addEventListener('hidden.bs.collapse', () => {
        navbar.classList.remove('menu-open');
    });

    function updateNavbar() {
        const navbar = document.getElementById('mainNavbar');

        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', updateNavbar);
    window.addEventListener('load', updateNavbar);

    document.querySelectorAll('.dropdown-submenu > a').forEach(el => {
        el.addEventListener('click', function (e) {
            if (window.innerWidth >= 992) return;
            e.preventDefault();
            e.stopPropagation();

            const next = this.nextElementSibling;
            if (!next) return;

            const isOpen = next.classList.contains('show');

            document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });

            if (!isOpen) {
                next.classList.add('show');
            }
        });
    });

    document.querySelectorAll('.dropdown').forEach(dropdown => {
        dropdown.addEventListener('hide.bs.dropdown', function () {
            this.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        });
    });

    document.addEventListener('click', function (e) {
        if (window.innerWidth >= 992) return;
        if (!e.target.closest('.dropdown-submenu')) {
            document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
</script>

@stack('scripts')

</body>
</html>
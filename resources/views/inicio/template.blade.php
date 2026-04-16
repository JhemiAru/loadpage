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

    <div class="hero-section">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg" id="mainNavbar">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                    <img src="{{ asset('imagen/institucion/' . ($institucion->imagen ?? 'facebol.png')) }}" alt="FaceBol" width=150px" height="80px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                    <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
                </button>
                <div class="collapse navbar-collapse" id="navMain">
                    <ul class="navbar-nav mx-auto gap-1">
                        <!-- Inicio -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Inicio</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('inicio') }}">Página Principal</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Empresas -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Empresas</a>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Actividades</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('actividad') }}">Todas las actividades</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Noticias -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Noticias</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('noticia') }}">Todas las noticias</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Equipo -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Nuestro Equipo</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('equipo') }}">Equipo de trabajo</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Contacto -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Contáctanos</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('contactanos') }}">Enviar mensaje</a>
                                </li>
                            </ul>
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
            <div class="row g-4">                                
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                    <img src="{{ asset('imagen/institucion/' . ($institucion->imagen ?? 'facebol.png')) }}" alt="FaceBol" width=150px" height="80px">
                </a>
                <div class="col-lg-5">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const navbar = document.querySelector('.navbar');
        const collapse = document.querySelector('.navbar-collapse');

        collapse.addEventListener('show.bs.collapse', () => {
            navbar.classList.add('menu-open');
        });

        collapse.addEventListener('hide.bs.collapse', () => {
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
                e.preventDefault();
                let next = this.nextElementSibling;
                if (next) {
                    next.classList.toggle('show');
                }
            });
        });
    </script>

    @stack('scripts')

    </body>
    </html>
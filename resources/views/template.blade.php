<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FaceBol SRL</title>        
    <link rel="shortcut icon" href="imagen/institucion/favicon_facebol.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap&font-display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    <link rel="preload" as="image" href="{{ asset('imagen/institucion/fondo.webp') }}" fetchpriority="high">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">    
    <script src="{{ asset('js/index.js') }}" defer></script>
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
                            <!-- <li>
                                <a class="dropdown-item" href="{{ route('comision') }}">Empresas por comisión</a>
                            </li> -->
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
                           Nosotros
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
                    <button href="#" class="btn btn-login" data-bs-toggle="modal" data-bs-target="#ms-account-modal">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </nav>
    @if(request()->routeIs('inicio'))
        @include('hero-carousel', ['institucion' => $institucion])
        <script src="{{ asset('js/carrusel.js') }}"></script>
    @endif
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
                    <img src="{{ asset('imagen/institucion/' . ($institucion->imagen ?? 'facebol.png')) }}" alt="FaceBol" style="max-width: 200px; width: 100% ">
                </a>
            </div>

            <div class="col-lg-5">
                <div class="d-flex align-items-start gap-2 mb-2">
                    <i class="fas fa-map-marker-alt footer-icon mt-1"></i>
                    <a href="https://maps.app.goo.gl/npVGBP5QBrFWfk6MA" target="_blank">
                        {{ $institucion->direccion ?? 'El Alto, Zona Ballivian, Av. Chacaltaya #50' }}
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fas fa-envelope footer-icon"></i>
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $institucion->email }}&su=Consulta%20FaceBol&body=Hola!%20Quiero%20más%20información%20de%20FaceBol." target="_blank">
                        {{ $institucion->email }}
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="fab fa-whatsapp footer-icon"></i>
                    <a href="https://api.whatsapp.com/send?phone=591{{$institucion->celular}}&text=Hola!%20Quiero%20más%20información%20de%20FaceBol." class="btn-circle btn-whatsapp" target="_blank">{{ $institucion->celular ?? '76266570' }}</a>
                </div>                
            </div>

            <div class="col-lg-3">
                <div class="text-center text-lg-end">                
                    <h5 class="mb-3">Redes Sociales</h5>
                    <div class="d-flex flex-wrap justify-content-center justify-content-lg-end gap-3">
                        @if($institucion->facebook)
                        <a href="{{ $institucion->facebook }}" class="btn-circle btn-facebook" target="_blank">
                            <i class="fab fa-facebook-f social-link"></i>
                        </a>
                        @endif
                        @if($institucion->youtube)
                        <a href="{{ $institucion->youtube }}" class="btn-circle btn-youtube" target="_blank">
                            <i class="fab fa-youtube social-link"></i>
                        </a>
                        @endif
                        @if($institucion->instagram)
                        <a href="{{ $institucion->instagram }}" class="btn-circle btn-instagram" target="_blank">
                            <i class="fab fa-instagram social-link"></i>
                        </a>
                        @endif
                        @if($institucion->twitter)
                        <a href="{{ $institucion->tiktok }}" class="btn-circle btn-tiktok" target="_blank">
                            <i class="fab fa-tiktok social-link"></i>
                        </a>
                        @endif
                        @if($institucion->celular)
                            <a href="https://api.whatsapp.com/send?phone=591{{ $institucion->celular }}&text=Hola!%20Quiero%20más%20información%20de%20FaceBol." 
                            class="btn-circle btn-whatsapp" target="_blank">
                                <i class="fab fa-whatsapp social-link"></i>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="footer-divider"></div>
        <p class="footer-copy text-center">Copyright © {{ date('Y') }} FaceBol S.R.L. Todos los derechos reservados.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>
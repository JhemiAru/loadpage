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
    <script src="{{ asset('js/template.js') }}" defer></script>
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
                            <li>
                                <a class="dropdown-item" href="{{ route('empresa') }}">Todas las empresas</a>
                            </li>
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
                        </ul>
                    </li>
                    
                    <!-- Actividades -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('actividad*') ? 'active' : '' }}" 
                           href="{{ route('actividad') }}">
                           Actividades
                        </a>
                    </li>
                    
                    <!-- Talleres -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('taller*') ? 'active' : '' }}" 
                           href="{{ route('taller') }}">
                           Talleres
                        </a>
                    </li>
                    
                    <!-- Equipo -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('equipo*') ? 'active' : '' }}" 
                           href="{{ route('equipo') }}">
                           Nosotros
                        </a>
                    </li>                    
                </ul>

                <!-- Inicio de Sesion / Usuario -->
                <div class="d-flex gap-2">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-user-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: transparent; border: none; display: flex; align-items: center; gap: 8px; color: white;">
                                @if(Auth::user()->imagen)
                                    <img src="{{ asset('imagen/usuarios/' . Auth::user()->imagen) }}" alt="Avatar" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div class="avatar-placeholder" style="width: 32px; height: 32px; border-radius: 50%; background: #f5a623; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #1a3a6b;">
                                        {{ strtoupper(substr(Auth::user()->nombre ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                                <span>{{ Auth::user()->nombre ?? 'Usuario' }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Sadministrador')
                                    <li><a class="dropdown-item" href="{{ route('start-a') }}"><i class="fas fa-tachometer-alt me-2"></i> Panel de control</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('perfil.show') }}"><i class="fas fa-user-circle me-2"></i> Mi perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a></li>
                            </ul>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <button class="btn btn-login" data-bs-toggle="modal" data-bs-target="#ms-account-modal">Iniciar Sesión</button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    @if(request()->routeIs('inicio'))
        @include('inicio.carrusel', ['institucion' => $institucion])
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
                        @if($institucion->tiktok)
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

<!-- Modal de Login y Recuperación -->
<div class="modal fade" id="ms-account-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-login">
        <div class="modal-content login-card"> 
            <div class="login-form-panel">
                <button type="button" class="login-close-btn d-none d-lg-flex" data-bs-dismiss="modal" aria-label="Cerrar">
                    <i class="fas fa-times"></i>
                </button>
 
                <ul class="login-tabs" id="loginTab" role="tablist">
                    <li>
                        <button class="login-tab-btn active" id="login-tab" data-bs-toggle="tab" data-bs-target="#ms-login-tab" type="button" role="tab" aria-selected="true">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar sesión
                        </button>
                    </li>
                    <li>
                        <button class="login-tab-btn" id="recovery-tab" data-bs-toggle="tab" data-bs-target="#ms-recovery-tab" type="button" role="tab" aria-selected="false">
                            <i class="fas fa-key me-2"></i>Recuperar
                        </button>
                    </li>
                </ul>
                <div class="login-tab-indicator"></div>
 
                <!-- Mostrar errores de autenticación aquí -->
                @if(session('error') || $errors->has('email'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') ?? $errors->first('email') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
 
                <div class="tab-content mt-4" id="loginTabContent">
                    <div class="tab-pane fade show active" id="ms-login-tab" role="tabpanel">
                        <form action="{{ route('log') }}" method="POST">
                            @csrf
                            <div class="login-field">
                                <label for="ms-form-user">Correo electrónico</label>
                                <div class="login-input-group">
                                    <span class="login-input-icon"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" id="ms-form-user" placeholder="usuario@ejemplo.com" required>
                                </div>
                            </div>
                            <div class="login-field">
                                <label for="ms-form-pass">Contraseña</label>
                                <div class="login-input-group">
                                    <span class="login-input-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" id="ms-form-pass" placeholder="••••••••" required>
                                    <button type="button" id="togglePassword" class="login-eye-btn" tabindex="-1">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="login-row-options">
                                <label class="login-check">
                                    <input type="checkbox" name="remember" id="remember">
                                    <span>Recordarme</span>
                                </label>
                                <a href="#" class="login-link" onclick="bootstrap.Tab.getInstance(document.getElementById('recovery-tab')).show(); return false;">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                            <button type="submit" class="btn-login-submit"><i class="fas fa-arrow-right me-2"></i>Ingresar</button>
                        </form>
                    </div>
 
                    <div class="tab-pane fade" id="ms-recovery-tab" role="tabpanel">
                        <div class="recovery-header">
                            <h5>Recuperar contraseña</h5>
                            <p>Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.</p>
                        </div>
                        <form action="{{ route('reset') }}" method="POST">
                            @csrf
                            <div class="login-field">
                                <label for="ms-form-email-re">Correo electrónico</label>
                                <div class="login-input-group">
                                    <span class="login-input-icon"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" id="ms-form-email-re" placeholder="usuario@ejemplo.com" required>
                                </div>
                            </div>
                            <button type="submit" class="btn-login-submit"><i class="fas fa-paper-plane me-2"></i>Enviar enlace</button>
                            <div class="text-center mt-3">
                                <a href="#" class="login-link" onclick="bootstrap.Tab.getInstance(document.getElementById('login-tab')).show(); return false;">
                                    <i class="fas fa-arrow-left me-1"></i> Volver al inicio de sesión
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    @if(session('error') || $errors->has('email'))
        var myModal = new bootstrap.Modal(document.getElementById('ms-account-modal'));
        myModal.show();
    @endif

    const togglePassword = document.querySelector('#togglePassword');
    if (togglePassword) {
        togglePassword.addEventListener('click', function () {
            const passwordInput = document.querySelector('#ms-form-pass');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }
</script>

@stack('scripts')

@if(session('open_login_modal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('ms-account-modal'));
            myModal.show();
        });
    </script>
@endif
</body>
</html>
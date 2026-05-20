<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel | @yield('titulo', 'FaceBol')</title>
    <link rel="shortcut icon" href="imagen/institucion/favicon_facebol.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel_layout.css') }}">    
    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <aside class="panel-sidebar" id="panelSidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                    <img src="{{ asset('imagen/institucion/' . ($institucion->imagen ?? 'facebol.png')) }}" alt="FaceBol" width="150px" height="auto">
                </a>
                <small>Panel de administración</small>
            </div>
            <button class="sidebar-close-mobile" id="sidebarCloseMobile">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">General</div>
            <a href="{{ route('start-a') }}" class="sidebar-link {{ request()->routeIs('start-a') ? 'active' : '' }}">
                <i class="fas fa-home"></i> <span>Inicio</span>
            </a>

            <div class="nav-section-label">Contenido</div>
            <a href="{{ route('indexTaller') }}" class="sidebar-link {{ request()->routeIs('indexTaller') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> <span>Talleres</span>
            </a>
            <a href="{{ route('indexEmpresa') }}" class="sidebar-link {{ request()->routeIs('indexEmpresa') ? 'active' : '' }}">
                <i class="fas fa-building"></i> <span>Empresas</span>
            </a>
            
        </nav>

        <div class="sidebar-footer">
            <button type="submit" class="btn-logout" action="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> <span>Cerrar sesión</span>
            </button>            
        </div>
    </aside>

    {{-- ── Contenido ── --}}
    <div class="panel-content">
        <div class="panel-topbar">
            <div class="topbar-left">
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h6 class="panel-title" id="panelTitle">@yield('titulo', 'Dashboard')</h6>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>
            </div>
        </div>

        <main class="panel-main">
            @if(session('success'))
                <div class="alert-success-panel panel-alert" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; margin-bottom: 20px; border-radius: 8px; transition: opacity 0.5s ease;">
                    <div>
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="close-alert-btn" style="background: none; border: none; color: inherit; cursor: pointer; font-size: 1rem; padding: 0 5px;">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error-panel panel-alert" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 16px; margin-bottom: 20px; border-radius: 8px; transition: opacity 0.5s ease;">
                    <div>
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                    </div>
                    <button type="button" class="close-alert-btn" style="background: none; border: none; color: inherit; cursor: pointer; font-size: 1rem; padding: 0 5px;">&times;</button>
                </div>
            @endif

            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
           document.addEventListener('DOMContentLoaded', function () {            
            const alerts = document.querySelectorAll('.panel-alert');

            alerts.forEach(function (alert) {
                const closeBtn = alert.querySelector('.close-alert-btn');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function () {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500); 
                    });
                }

                setTimeout(function () {
                    if (alert) {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500); 
                    }
                }, 5000); 
            });
        });
        // Sistema de sidebar responsive
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('panelSidebar');
            const mobileToggle = document.getElementById('mobileMenuToggle');
            const sidebarClose = document.getElementById('sidebarCloseMobile');
            const overlay = document.getElementById('sidebarOverlay');
            
            // Verificar si estamos en móvil (viewport < 768px)
            function isMobile() {
                return window.innerWidth < 768;
            }
            
            // Abrir sidebar
            function openSidebar() {
                if (isMobile()) {
                    sidebar.classList.add('mobile-open');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            // Cerrar sidebar
            function closeSidebar() {
                if (isMobile()) {
                    sidebar.classList.remove('mobile-open');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
            
            // Toggle sidebar (abrir/cerrar)
            function toggleSidebar() {
                if (sidebar.classList.contains('mobile-open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            }
            
            // Event listeners
            if (mobileToggle) {
                mobileToggle.addEventListener('click', toggleSidebar);
            }
            
            if (sidebarClose) {
                sidebarClose.addEventListener('click', closeSidebar);
            }
            
            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }
            
            // Cerrar sidebar al cambiar de tamaño de ventana a desktop
            window.addEventListener('resize', function() {
                if (!isMobile() && sidebar.classList.contains('mobile-open')) {
                    closeSidebar();
                }
            });
            
            // Prevenir que los enlaces del sidebar cierren el menú automáticamente
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (isMobile()) {
                        setTimeout(closeSidebar, 150);
                    }
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
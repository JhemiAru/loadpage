<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin — @yield('titulo', 'FaceBol')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary:      #1a3a6b;
            --accent:       #f5a623;
            --accent2:      #e06b2d;
            --blue-light:   #2e6bc4;
            --text-dark:    #1a2340;
            --text-muted:   #6b7280;
            --section-bg:   #f4f7fc;
            --sidebar-w:    240px;
        }

        *, body { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Open Sans', sans-serif;
            background: var(--section-bg);
            color: var(--text-dark);
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        /* ── Sidebar ── */
        .panel-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--primary);
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-logo span {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
        }

        .sidebar-logo small {
            display: block;
            color: rgba(255,255,255,0.5);
            font-size: 0.72rem;
            margin-top: 2px;
        }

        .sidebar-nav {
            padding: 16px 0;
            flex: 1;
        }

        .nav-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.35);
            padding: 12px 20px 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(255,255,255,0.08);
            color: white;
            border-left-color: var(--accent);
        }

        .sidebar-link i {
            width: 18px;
            text-align: center;
            font-size: 0.95rem;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.6);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .btn-logout:hover { color: #ff7070; }

        /* ── Contenido principal ── */
        .panel-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ── */
        .panel-topbar {
            background: white;
            border-bottom: 1px solid #e5e9f0;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .panel-topbar h6 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .topbar-user .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }

        /* ── Main ── */
        .panel-main {
            padding: 28px;
            flex: 1;
        }

        /* ── Cards ── */
        .panel-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e9f0;
            box-shadow: 0 2px 12px rgba(26,58,107,0.05);
            overflow: hidden;
        }

        .panel-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f0f3f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-card-header h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
        }

        /* ── Botones ── */
        .btn-primary-panel {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 9px 20px;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: background 0.25s, transform 0.2s;
            cursor: pointer;
        }

        .btn-primary-panel:hover {
            background: var(--blue-light);
            color: white;
            transform: translateY(-1px);
        }

        .btn-accent-panel {
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 7px 16px;
            font-weight: 600;
            font-size: 0.8rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.25s;
            cursor: pointer;
        }

        .btn-accent-panel:hover { background: var(--accent2); color: white; }

        .btn-danger-panel {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 8px;
            padding: 7px 16px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.25s;
            cursor: pointer;
        }

        .btn-danger-panel:hover { background: #dc2626; color: white; }

        /* ── Tabla ── */
        .panel-table { width: 100%; border-collapse: collapse; }
        .panel-table th {
            background: var(--section-bg);
            color: var(--primary);
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 16px;
            border-bottom: 2px solid #e5e9f0;
            text-align: left;
        }

        .panel-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f3f9;
            font-size: 0.875rem;
            color: var(--text-dark);
            vertical-align: middle;
        }

        .panel-table tr:last-child td { border-bottom: none; }
        .panel-table tr:hover td { background: #fafbfe; }

        /* ── Formularios ── */
        .form-label-panel {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 6px;
            display: block;
        }

        .form-control-panel {
            width: 100%;
            border: 1.5px solid #dde2ee;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            color: var(--text-dark);
            font-family: 'Open Sans', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
        }

        .form-control-panel:focus {
            outline: none;
            border-color: var(--blue-light);
            box-shadow: 0 0 0 3px rgba(46,107,196,0.15);
        }

        .form-control-panel.is-invalid {
            border-color: #dc2626;
        }

        .field-error {
            font-size: 0.78rem;
            color: #dc2626;
            margin-top: 4px;
        }

        .form-group { margin-bottom: 20px; }

        /* ── Alerts ── */
        .alert-success-panel {
            background: #ecfdf5;
            border: 1px solid #6ee7b7;
            border-radius: 10px;
            padding: 12px 18px;
            color: #065f46;
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        /* ── Badge ── */
        .badge-panel {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .badge-fecha {
            background: rgba(46,107,196,0.1);
            color: var(--blue-light);
        }

        .badge-costo {
            background: rgba(245,166,35,0.15);
            color: var(--accent2);
        }

        /* ── Imagen preview ── */
        .img-preview {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e5e9f0;
        }

        .img-preview-large {
            max-width: 180px;
            max-height: 130px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #e5e9f0;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .panel-sidebar { transform: translateX(-100%); }
            .panel-content { margin-left: 0; }
            .panel-main { padding: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- ── Sidebar ── --}}
    <aside class="panel-sidebar">
        <div class="sidebar-logo">
            <span>&#9654; FaceBol</span>
            <small>Panel de administración</small>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">General</div>
            <a href="{{ route('start-a') }}" class="sidebar-link {{ request()->routeIs('start-a') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Inicio
            </a>

            <div class="nav-section-label">Contenido</div>
            <a href="{{ route('indexTaller') }}" class="sidebar-link {{ request()->routeIs('indexTaller') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> Talleres
            </a>
            {{-- Aquí puedes agregar más secciones --}}
        </nav>

        <div class="sidebar-footer">
            {{-- <form method="POST" action="{{ route('logout-a') }}"> --}}
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                </button>
            {{-- </form> --}}
        </div>
    </aside>

    {{-- ── Contenido ── --}}
    <div class="panel-content">
        <div class="panel-topbar">
            <h6>@yield('titulo', 'Panel')</h6>
            <div class="topbar-user">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <span>{{ Auth::user()->name ?? 'Admin' }}</span>
            </div>
        </div>

        <main class="panel-main">
            @if(session('success'))
                <div class="alert-success-panel">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

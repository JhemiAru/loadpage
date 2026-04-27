@extends('template')

@push('styles')
<style>
/* ───────────────────────────────────────────────
   EMPRESAS — vista completa
─────────────────────────────────────────────── */

/* ── HERO / BUSCADOR ── */
.empresas-hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--blue-light) 100%);
    padding: 60px 0 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.empresas-hero::before {
    content: "";
    position: absolute;
    top: -50%; right: -10%;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    pointer-events: none;
}

.empresas-hero::after {
    content: "";
    position: absolute;
    bottom: -30%; left: -5%;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: rgba(245,166,35,0.08);
    pointer-events: none;
}

.empresas-hero h1 {
    font-family: 'Poppins', sans-serif;
    font-size: 2.4rem;
    font-weight: 800;
    color: white;
    margin-bottom: 10px;
}

.empresas-hero h1 span { color: var(--accent); }

.empresas-hero p.lead {
    color: rgba(255,255,255,0.82);
    font-size: 1rem;
    margin-bottom: 0;
}

.empresas-hero-wave {
    display: block;
    width: 100%;
    margin-bottom: -2px;
    margin-top: 40px;
}

/* Buscador */
.search-wrap {
    position: relative;
    max-width: 600px;
    margin: 28px auto 0;
}

.search-input-hero {
    width: 100%;
    border: none;
    border-radius: 50px;
    padding: 14px 56px 14px 24px;
    font-size: 0.98rem;
    font-family: 'Open Sans', sans-serif;
    color: var(--text-dark);
    box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    outline: none;
    transition: box-shadow 0.25s;
}

.search-input-hero:focus {
    box-shadow: 0 8px 30px rgba(0,0,0,0.2), 0 0 0 3px rgba(245,166,35,0.4);
}

.btn-search-hero {
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    background: var(--accent);
    color: #fff;
    border: none;
    border-radius: 50px;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-search-hero:hover { background: var(--accent2); }

/* Sugerencias autocomplete */
#suggestions {
    position: absolute;
    top: calc(100% + 8px);
    left: 0; right: 0;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 12px 36px rgba(0,0,0,0.15);
    z-index: 999;
    overflow: hidden;
    display: none;
}

.suggestion-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 16px;
    cursor: pointer;
    transition: background 0.2s;
    text-decoration: none;
    color: var(--text-dark);
}

.suggestion-item:hover { background: #f4f7fc; }

.suggestion-img {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    object-fit: cover;
    flex-shrink: 0;
    background: #e8f0fe;
}

.suggestion-img-placeholder {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #e8f0fe;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue-light);
    flex-shrink: 0;
}

.suggestion-info { flex: 1; min-width: 0; }

.suggestion-nombre {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 0.88rem;
    color: var(--primary);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.suggestion-meta {
    font-size: 0.75rem;
    color: var(--text-muted);
}

.suggestion-desc { font-size: 0.75rem; color: var(--accent2); font-weight: 600; }

/* Stats búsqueda */
.search-stats {
    background: rgba(255,255,255,0.13);
    backdrop-filter: blur(8px);
    border-radius: 50px;
    padding: 6px 18px;
    font-size: 0.82rem;
    color: rgba(255,255,255,0.9);
    display: inline-block;
    margin-top: 14px;
}

/* ── SECCIÓN LISTADO ── */
.empresas-section {
    background: var(--section-bg);
    padding: 48px 0 70px;
}

/* Cabecera de resultados */
.resultados-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 30px;
}

.resultados-header h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--primary);
    margin: 0;
}

.resultados-header h2 span { color: var(--accent); }

.badge-total {
    background: var(--accent);
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 0.78rem;
    padding: 4px 14px;
    border-radius: 20px;
}

/* ── TARJETA DE EMPRESA ── */
.empresa-card-v2 {
    background: var(--card-bg);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 5px 18px rgba(26,58,107,0.08);
    border: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.empresa-card-v2:hover {
    transform: translateY(-7px);
    box-shadow: 0 16px 36px rgba(26,58,107,0.16);
    border-color: rgba(46,107,196,0.2);
}

/* Imagen principal */
.empresa-img-wrap {
    position: relative;
    height: 180px;
    overflow: hidden;
    background: #f0f4fa;
    flex-shrink: 0;
}

.empresa-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.empresa-card-v2:hover .empresa-img-wrap img {
    transform: scale(1.06);
}

.empresa-img-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e8f0fe, #d4e2fc);
    font-size: 3rem;
    color: var(--blue-light);
}

/* Badge descuento flotante */
.badge-descuento-card {
    position: absolute;
    top: 10px;
    right: 10px;
    background: var(--accent);
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 0.72rem;
    padding: 4px 12px;
    border-radius: 20px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    max-width: 140px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Logo de la empresa sobre imagen */
.empresa-logo-badge {
    position: absolute;
    bottom: -20px;
    left: 16px;
    width: 52px;
    height: 52px;
    border-radius: 14px;
    border: 3px solid #fff;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    flex-shrink: 0;
}

.empresa-logo-badge img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Cuerpo */
.empresa-card-body-v2 {
    padding: 28px 18px 16px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.empresa-card-body-v2 h5 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 1rem;
    color: var(--primary);
    margin-bottom: 6px;
    line-height: 1.3;
}

.empresa-meta-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 12px;
}

.meta-chip {
    background: #f0f4fb;
    border-radius: 20px;
    padding: 3px 10px;
    font-size: 0.74rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 4px;
}

.meta-chip i { color: var(--blue-light); font-size: 0.72rem; }

.empresa-desc-card {
    font-size: 0.83rem;
    color: var(--text-muted);
    line-height: 1.5;
    margin-bottom: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}

/* Footer tarjeta */
.empresa-card-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: auto;
    flex-wrap: wrap;
}

.btn-detalle-card {
    flex: 1;
    background: linear-gradient(135deg, var(--primary), var(--blue-light));
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 0.82rem;
    border-radius: 20px;
    padding: 8px 16px;
    text-decoration: none;
    text-align: center;
    transition: all 0.25s;
    display: block;
}

.btn-detalle-card:hover {
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(26,58,107,0.25);
}

.btn-wa-card {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #e8f5e9;
    color: #25d366;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.2s;
    flex-shrink: 0;
}

.btn-wa-card:hover {
    background: #25d366;
    color: #fff;
    transform: scale(1.1);
}

/* ── SIN RESULTADOS ── */
.no-results {
    text-align: center;
    padding: 70px 20px;
    color: var(--text-muted);
}

.no-results i {
    font-size: 3.5rem;
    color: #ccd3e0;
    margin-bottom: 16px;
    display: block;
}

.no-results h5 {
    font-family: 'Poppins', sans-serif;
    color: var(--primary);
    margin-bottom: 8px;
}

.btn-limpiar {
    background: var(--blue-light);
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 0.85rem;
    border-radius: 20px;
    padding: 9px 22px;
    text-decoration: none;
    display: inline-block;
    margin-top: 12px;
    transition: all 0.2s;
}

.btn-limpiar:hover {
    background: var(--primary);
    color: #fff;
}

/* ── PAGINACIÓN ── */
.pagination {
    flex-wrap: wrap;
    gap: 4px;
    justify-content: center;
}

.pagination .page-item .page-link {
    border-radius: 10px !important;
    border: none;
    color: var(--blue-light);
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    margin: 0;
    padding: 7px 13px;
    font-size: 0.88rem;
    line-height: 1.4;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    transition: all 0.2s;
    background-size: 0.7em;
}

.pagination .page-item.active .page-link {
    background: var(--primary);
    color: #fff;
    box-shadow: 0 4px 12px rgba(26,58,107,0.2);
}

.pagination .page-item .page-link:hover {
    background: var(--blue-light);
    color: #fff;
}
</style>
@endpush

@section('content')

{{-- ── HERO / BUSCADOR ── --}}
<section class="empresas-hero">
    <div class="container">
        <div class="text-center" style="position:relative; z-index:1">
            <h1>Nuestras <span>Empresas</span></h1>
            <p class="lead">Encuentra descuentos y beneficios buscando por nombre, categoría o ciudad.</p>

            {{-- Formulario de búsqueda --}}
            <form action="{{ route('search') }}" method="GET" id="searchForm" autocomplete="off">
                <div class="search-wrap">
                    <input
                        type="search"
                        id="searchInput"
                        name="query"
                        class="search-input-hero"
                        placeholder="Ej: comidas, tecnología, La Paz..."
                        value="{{ $query ?? '' }}"
                    >
                    <button type="submit" class="btn-search-hero">
                        <i class="fas fa-search"></i>
                    </button>
                    <div id="suggestions"></div>
                </div>

                @if(!empty($query))
                    <div class="search-stats mt-2">
                        <i class="fas fa-filter me-1"></i>
                        Mostrando resultados para: <strong>{{ $query }}</strong>
                        &nbsp;·&nbsp;
                        <a href="{{ route('search') }}" style="color:#ffd166; font-weight:700">Limpiar</a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Ola de transición --}}
    <svg class="empresas-hero-wave" viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0,30 C360,70 1080,-10 1440,30 L1440,60 L0,60 Z" fill="#f4f7fc"/>
    </svg>
</section>

{{-- ── LISTADO ── --}}
<section class="empresas-section">
    <div class="container">

        {{-- Cabecera de resultados --}}
        <div class="resultados-header">
            <h2>
                @if(!empty($query))
                    Resultados para <span>"{{ $query }}"</span>
                @else
                    Empresas <span>aliadas</span>
                @endif
            </h2>
            <span class="badge-total">
                <i class="fas fa-store me-1"></i>
                123
            </span>
        </div>

        @if($empresas->isNotEmpty())
            <div class="row g-4" id="empresasGrid">
                @foreach($empresas as $empresa)
                    <div class="col-lg-4 col-md-6">
                        <div class="empresa-card-v2">

                            {{-- Imagen de portada + logo superpuesto --}}
                            <div class="empresa-img-wrap">
                                @if($empresa->imagen)
                                    <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                                         alt="{{ $empresa->nombre }}"
                                         loading="lazy">
                                @else
                                    <div class="empresa-img-placeholder">
                                        <i class="fas fa-store"></i>
                                    </div>
                                @endif

                                @if($empresa->descuento)
                                    <span class="badge-descuento-card">
                                        <i class="fas fa-tag me-1"></i>{{ $empresa->descuento }}
                                    </span>
                                @endif

                                {{-- Logo pequeño flotante sobre la imagen --}}
                                @if($empresa->imagen)
                                    <div class="empresa-logo-badge">
                                        <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                                             alt="Logo {{ $empresa->nombre }}">
                                    </div>
                                @endif
                            </div>

                            {{-- Cuerpo --}}
                            <div class="empresa-card-body-v2">
                                <h5>{{ $empresa->nombre }}</h5>

                                {{-- Chips de categoría y ciudad --}}
                                <div class="empresa-meta-chips">
                                    @if($empresa->categoria)
                                        <span class="meta-chip">
                                            <i class="{{ $empresa->categoria->icono ?? 'fas fa-tag' }}"></i>
                                            {{ $empresa->categoria->nombre }}
                                        </span>
                                    @endif
                                    @if($empresa->ciudad)
                                        <span class="meta-chip">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $empresa->ciudad->nombre }}
                                        </span>
                                    @endif
                                    <span class="meta-chip">
                                        <i class="fas fa-eye"></i>
                                        {{ $empresa->nvisitas ?? 0 }} visitas
                                    </span>
                                </div>

                                @if($empresa->descripcion)
                                    <p class="empresa-desc-card">{{ $empresa->descripcion }}</p>
                                @endif

                                {{-- Acciones --}}
                                <div class="empresa-card-actions">
                                    <a href="{{ route('detalleEmpresa', $empresa->slug) }}"
                                       class="btn-detalle-card">
                                        Ver empresa <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                    @if($empresa->celular)
                                        <a href="https://api.whatsapp.com/send?phone=591{{ $empresa->celular }}&text=Hola!%20Vi%20su%20empresa%20en%20FaceBol%20y%20quiero%20más%20información."
                                           class="btn-wa-card"
                                           target="_blank"
                                           title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginación --}}
            @if($empresas->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $empresas->links() }}
                </div>
            @endif

        @else
            <div class="no-results">
                <i class="fas fa-store-slash"></i>
                @if(!empty($query))
                    <h5>Sin resultados para "{{ $query }}"</h5>
                    <p>Intenta con otro término: nombre de empresa, categoría o ciudad.</p>
                    <a href="{{ route('search') }}" class="btn-limpiar">Ver todas las empresas</a>
                @else
                    <h5>No hay empresas disponibles en este momento.</h5>
                @endif
            </div>
        @endif

    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input        = document.getElementById('searchInput');
    const suggestions  = document.getElementById('suggestions');
    let   debounceTimer;

    // ── Autocompletado ──
    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const q = this.value.trim();

        if (q.length < 2) {
            hideSuggestions();
            return;
        }

        debounceTimer = setTimeout(() => fetchSuggestions(q), 280);
    });

    async function fetchSuggestions(q) {
        try {
            const res  = await fetch(`/empresas/json?query=${encodeURIComponent(q)}`);
            const data = await res.json();
            renderSuggestions(data, q);
        } catch (e) {
            hideSuggestions();
        }
    }

    function renderSuggestions(data, q) {
        if (!data.length) { hideSuggestions(); return; }

        suggestions.innerHTML = data.map(item => {
            const img = item.imagen
                ? `<img src="/imagen/empresas/${item.imagen}" class="suggestion-img" alt="">`
                : `<div class="suggestion-img-placeholder"><i class="fas fa-store"></i></div>`;

            const meta = [item.categoria, item.ciudad].filter(Boolean).join(' · ');
            const desc = item.descuento
                ? `<span class="suggestion-desc">${item.descuento}</span>` : '';

            return `
                <a href="/empresa/${item.slug}" class="suggestion-item">
                    ${img}
                    <div class="suggestion-info">
                        <div class="suggestion-nombre">${highlight(item.nombre, q)}</div>
                        <div class="suggestion-meta">${meta}</div>
                    </div>
                    ${desc}
                </a>`;
        }).join('');

        suggestions.style.display = 'block';
    }

    // Resalta el término buscado en el nombre
    function highlight(text, q) {
        const re = new RegExp(`(${q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(re, '<mark style="background:#fff3cd;border-radius:3px;padding:0 2px">$1</mark>');
    }

    function hideSuggestions() {
        suggestions.style.display = 'none';
        suggestions.innerHTML = '';
    }

    // Cerrar al hacer clic fuera
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.search-wrap')) hideSuggestions();
    });

    // Cerrar al presionar Escape
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') hideSuggestions();
    });
});
</script>
@endpush

@endsection
@extends('template')

@push('styles')
<style>
    /* Hero empresas - paleta del sitio */
    .empresas-hero {
        background: linear-gradient(135deg, var(--primary) 0%, var(--blue-light) 100%);
        padding: 80px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .empresas-hero::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
        pointer-events: none;
    }

    .empresas-hero::after {
        content: "";
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(245, 166, 35, 0.08);
        pointer-events: none;
    }

    .empresas-hero h1 {
        font-size: 2.8rem;
        font-weight: 800;
        color: white;
    }

    .empresas-hero h1 span {
        color: var(--accent);
    }

    .empresas-hero p.lead {
        color: rgba(255, 255, 255, 0.85);
        font-size: 1.1rem;
    }

    /* Buscador */
    .search-wrapper {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.2);
    }

    .search-input-modern {
        background: rgba(255, 255, 255, 0.95) !important;
        border-radius: 50px !important;
        padding: 12px 24px !important;
        border: none !important;
        font-size: 1rem;
        color: var(--text-dark);
        box-shadow: none !important;
    }

    .search-input-modern:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.35) !important;
    }

    .btn-buscar {
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 28px;
        font-weight: 600;
        transition: background 0.3s;
    }

    .btn-buscar:hover {
        background: white;
        color: var(--blue-light);
    }

    /* Sección listado */
    .empresas-section {
        background: var(--section-bg);
        padding: 60px 0;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 8px;
    }

    .section-title span {
        color: var(--accent);
    }

    /* Tarjetas de empresa */
    .branch-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.35s cubic-bezier(0.165, 0.84, 0.44, 1),
                    box-shadow 0.35s ease;
        box-shadow: 0 6px 24px rgba(26, 58, 107, 0.09);
        background: #fff;
        height: 100%;
        position: relative;
    }

    .branch-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 48px rgba(26, 58, 107, 0.18);
    }

    .branch-img-container {
        position: relative;
        height: 220px;
    }

    .branch-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Overlay info sobre imagen */
    .branch-info-overlay {
        position: absolute;
        bottom: 12px;
        left: 12px;
        right: 12px;
        background: rgba(26, 58, 107, 0.72);
        backdrop-filter: blur(8px);
        padding: 14px 16px;
        border-radius: 14px;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .branch-info-overlay h4 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .branch-info-overlay .direccion {
        font-size: 0.78rem;
        opacity: 0.85;
        margin-bottom: 8px;
    }

    .badge-abierto {
        font-size: 0.65rem;
        padding: 4px 10px;
        border-radius: 50px;
        background: rgba(255, 255, 255, 0.92);
        color: var(--primary);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-ver-detalle {
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 5px 14px;
        text-decoration: none;
        transition: background 0.25s;
    }

    .btn-ver-detalle:hover {
        background: white;
        color: var(--blue-light);
    }

    /* Footer de tarjeta */
    .branch-card-footer {
        padding: 10px 16px;
        border-top: 1px solid #eef0f5;
        background: #fafbfe;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .branch-card-footer small {
        color: var(--text-muted);
        font-size: 0.8rem;
    }

    .branch-card-footer i {
        margin-right: 4px;
    }

    /* Sin resultados */
    .no-results {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }

    .no-results i {
        font-size: 3rem;
        color: #ccd3e0;
        margin-bottom: 16px;
        display: block;
    }
</style>
@endpush

@section('content')

    {{-- HERO --}}
    <section class="empresas-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center mb-4">
                    <h1>{{ $institucion->tituloempresa ?? 'Nuestras <span>Empresas</span>' }}</h1>
                    <p class="lead">{{ $institucion->desEmpresa ?? 'Encuentra los mejores descuentos y beneficios en nuestras empresas aliadas.' }}</p>
                </div>

                <div class="col-md-8 offset-md-2">
                    <div class="search-wrapper">
                        <div class="d-flex gap-2">
                            <input 
                                id="search" 
                                type="text" 
                                class="form-control search-input-modern flex-grow-1" 
                                placeholder="Buscar empresa por nombre..."
                                autocomplete="off"
                            >
                            <button class="btn-buscar">
                                <i class="fas fa-search me-1"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LISTADO DE EMPRESAS --}}
    <section class="empresas-section">
        <div class="container">
            <h2 class="section-title text-center mb-1">
                Empresas <span>aliadas</span>
            </h2>
            <p class="subtitle mb-5">Descuentos y promociones en todos estos establecimientos</p>

            <div class="row g-4">
                @forelse($empresas as $empresa)
                    @if($empresa->activo == 1)
                    <div class="col-lg-4 col-md-6">
                        <div class="branch-card">
                            <div class="branch-img-container">
                                <img 
                                    src="{{ asset('imagen/empresas/' . $empresa->imagen) }}" 
                                    alt="{{ $empresa->nombre }}"
                                    loading="lazy"
                                >

                                <div class="branch-info-overlay">
                                    <h4>{{ $empresa->nombre }}</h4>
                                    <p class="direccion mb-0">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ $empresa->direccion ?? 'Ubicación disponible' }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="badge-abierto">Abierto</span>
                                        <a href="{{ route('detalleEmpresa', $empresa->slug) }}" class="btn-ver-detalle">
                                            Ver detalles
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="branch-card-footer">
                                <small>
                                    <i class="fas fa-tag text-warning"></i>
                                    {{ $empresa->descuento ?? 'Sin descuento' }}
                                </small>
                                <small>
                                    <i class="fas fa-eye" style="color: var(--blue-light)"></i>
                                    {{ $empresa->nvisitas ?? 0 }} visitas
                                </small>
                            </div>
                        </div>
                    </div>
                    @endif
                @empty
                    <div class="col-12">
                        <div class="no-results">
                            <i class="fas fa-store-slash"></i>
                            <h5>No hay empresas disponibles en este momento.</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script src="{{ asset('js/typeahead.bundle.js') }}"></script>
<script>
    $(function () {
        var empresas = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '{{ url("empresas/json") }}'
        });

        $('#search').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'empresas',
            source: empresas
        });
    });
</script>
@endpush
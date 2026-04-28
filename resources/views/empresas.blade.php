@extends('template')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/empresa.css') }}">
@endpush

@section('content')
<section class="empresas-hero">
    <div class="container">
        <div class="text-center" style="position:relative; z-index:1">
            <h1>Nuestras <span>Empresas</span></h1>
            <p class="lead">Encuentra descuentos y beneficios buscando por nombre, categoría o ciudad.</p>            
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

    <svg class="empresas-hero-wave" viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0,30 C360,70 1080,-10 1440,30 L1440,60 L0,60 Z" fill="#f4f7fc"/>
    </svg>
</section>

<section class="empresas-section">
    <div class="container">

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
                 {{ $countEmpresas }} {{ $countEmpresas === 1 ? 'empresa' : 'empresas' }}
            </span>
        </div>

        @if($empresas->isNotEmpty())
            <div class="row g-4" id="empresasGrid">
                @foreach($empresas as $empresa)
                    <div class="col-lg-4 col-md-6">
                        <div class="empresa-card-v2">
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
                            </div>
                            <div class="empresa-card-body-v2">
                                <h5>{{ $empresa->nombre }}</h5>
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
                                <div class="empresa-card-actions">
                                    @if($empresa->imagen)
                                        <div class="empresa-logo-inline">
                                            <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                                                alt="Logo {{ $empresa->nombre }}">
                                        </div>
                                    @endif
                                    <a href="{{ route('detalleEmpresa', $empresa->slug) }}"
                                       class="btn-detalle-card">
                                        Ver empresa <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                    @if($empresa->telefono)
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

            @if($empresas->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    @if ($empresas->hasPages())
                        <nav class="custom-pagination-wrapper">
                            <ul class="pagination">
                                <li class="page-item {{ $empresas->onFirstPage() ? 'disabled' : '' }}">
                                    @if ($empresas->onFirstPage())
                                        <span class="page-link">‹ Anterior</span>
                                    @else
                                        <a class="page-link" href="{{ $empresas->previousPageUrl() }}">‹ Anterior</a>
                                    @endif
                                </li>
                                @for ($i = 1; $i <= $empresas->lastPage(); $i++)
                                    <li class="page-item {{ $i == $empresas->currentPage() ? 'active' : '' }}">
                                        @if ($i == $empresas->currentPage())
                                            <span class="page-link">{{ $i }}</span>
                                        @else
                                            <a class="page-link" href="{{ $empresas->url($i) }}">{{ $i }}</a>
                                        @endif
                                    </li>
                                @endfor
                                <li class="page-item {{ $empresas->hasMorePages() ? '' : 'disabled' }}">
                                    @if ($empresas->hasMorePages())
                                        <a class="page-link" href="{{ $empresas->nextPageUrl() }}">Siguiente ›</a>
                                    @else
                                        <span class="page-link">Siguiente ›</span>
                                    @endif
                                </li>
                            </ul>
                        </nav>
                        @endif
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
<script src="{{ asset('js/empresa.js') }}"></script>
@endpush

@endsection
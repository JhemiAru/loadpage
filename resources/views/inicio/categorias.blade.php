@extends('inicio.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/categoria.css') }}">
@endpush

@section('content')
<section class="categoria-hero">
    <div class="container">
        <div class="categoria-icon-big">
            <i class="{{ $categoria->icono ?? 'fas fa-tag' }}"></i>
        </div>
        <h1>{{ $categoria->nombre }}</h1>

        @if($categoria->descripcion)
            <p class="descripcion-cat">{{ $categoria->descripcion }}</p>
        @endif

        <span class="badge-count">
            <i class="fas fa-building me-1"></i>
            {{ $countEmpresas }} {{ $countEmpresas === 1 ? 'empresa' : 'empresas' }} en esta categoría
        </span>
    </div>
</section>

<div class="buscador-flotante-wrap">
    <div class="container mb-0 mt-0">
        <form action="{{ route('categoriaBuscar', $categoria->slug) }}" method="GET" autocomplete="off">
            <div class="search-wrap">
                <input
                    type="text"
                    name="query"
                    id="searchInput"
                    class="search-input-hero"
                    data-slug="{{ $categoria->slug }}"
                    placeholder="Buscar empresas en {{ $categoria->nombre }}..."
                    value="{{ request('query') }}"
                    autocomplete="off"
                >
                <button class="btn-search-hero" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                <div id="suggestions"></div>
            </div>

            @if(!empty($query))
                <div class="text-center mt-2">
                    <span class="search-stats-cat">
                        <i class="fas fa-filter me-1"></i>
                        Resultados para: <strong>{{ $query }}</strong>
                        &nbsp;·&nbsp;
                        <a href="{{ route('categoria', $categoria->slug) }}" style="color:var(--accent); font-weight:700">Limpiar</a>
                    </span>
                </div>
            @endif
        </form>
    </div>
</div>


<section class="empresas-section">
    <div class="container">
        @if($empresas->isNotEmpty())
            <div class="row g-4">
                @foreach($empresas as $empresa)
                    @if($empresa->activo == 1)
                    <div class="col-lg-4 col-md-6">
                        <div class="empresa-card">
                            <div class="empresa-card-img-wrap">
                                @if($empresa->imagen)
                                    <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                                         alt="{{ $empresa->nombre }}">
                                @else
                                    <div class="empresa-card-img-placeholder">
                                        <i class="fas fa-store"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="empresa-card-body">
                                <h5>{{ $empresa->nombre }}</h5>
                                @if($empresa->descuento)
                                    <div class="empresa-descuento-inline">
                                        <i class="fas fa-tags"></i>
                                        <span>{{ $empresa->descuento }}</span>
                                    </div>
                                @endif
                                @if($empresa->descripcion)
                                    <p class="empresa-desc">
                                        {{$empresa->descripcion_corta}}
                                    </p>
                                @endif
                                <div class="empresa-contacto">
                                    @if($empresa->facebook)
                                        <a href="{{ $empresa->facebook }}"
                                           class="btn-contacto btn-contacto-fb"
                                           target="_blank"
                                           title="Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if($empresa->email)
                                        <a href="mailto:{{ $empresa->email }}"
                                           class="btn-contacto btn-contacto-mail"
                                           title="Correo">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    @endif
                                    @if($empresa->web)
                                        <a href="{{ $empresa->web }}"
                                           class="btn-contacto btn-contacto-web"
                                           target="_blank"
                                           title="Sitio web">
                                            <i class="fas fa-globe"></i>
                                        </a>
                                    @endif
                                    @if($empresa->celular)
                                        <a href="https://api.whatsapp.com/send?phone=591{{ $empresa->celular }}&text=Hola!%20Vi%20su%20empresa%20en%20FaceBol%20y%20quiero%20más%20información."
                                           class="btn-contacto btn-contacto-wa"
                                           target="_blank"
                                           title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="empresa-card-footer">
                                    <a href="{{ route('detalleEmpresa', $empresa->slug) }}"
                                       class="btn-ver-mas">
                                        Ver empresa <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endif
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
            <div class="empty-state">
                <i class="fas fa-store-slash"></i>
                <h4>No hay empresas en esta categoría</h4>
                <p>No se encontraron empresa en la categoría <strong>{{ $categoria->nombre }}</strong>.</p>
                <a href="{{ route('categoria', ['slug' => request()->route('slug')]) }}" class="btn-ver-mas d-inline-block mt-3" style="max-width:220px">
                    Volver
                </a>
                <a href="{{ route('empresa') }}"
                   class="btn-ver-empresa d-inline-block mt-3">
                    Ver todas las empresas
                </a>
            </div>
        @endif

    </div>
</section>

@push('scripts')
    <script src="{{ asset('js/categoria.js') }}"></script>
@endpush

@endsection
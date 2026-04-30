@extends('template')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/ciudad.css') }}">
@endpush

@section('content')

<section class="ciudad-hero">
    <div class="ciudad-hero-inner">
        <div class="container">
            <div class="ciudad-pin">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h1>{{ $ciudad->nombre }}</h1>
            <p class="subtitulo-ciudad">
                Empresas con beneficios y descuentos en esta ciudad
            </p>
        </div>
    </div>
    <svg class="ciudad-hero-wave" viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0,30 C360,80 1080,-20 1440,30 L1440,60 L0,60 Z" fill="#f4f7fc"/>
    </svg>
</section>

<div class="ciudad-stats-bar">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="stat-item">
                    <i class="fas fa-store"></i>
                    <span>{{ $countEmpresas }} {{ $countEmpresas === 1 ? 'empresa' : 'empresas' }} en {{ $ciudad->nombre }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="buscador-ciudad">
    <div class="container mb-0 mt-0">
        <form method="GET" action="{{ route('ciudadBuscar', $ciudad->id) }}">
            <div class="search-wrap-ciudad">
                <input
                    type="text"
                    name="query"
                    id="searchInputCiudad"
                    class="search-input-ciudad"
                    data-ciudad-id="{{ $ciudad->id }}"
                    placeholder="Buscar empresa en {{ $ciudad->nombre }}..."
                    value="{{ $query ?? request('query') }}"
                    autocomplete="off"
                >
                <button class="btn-buscar-ciudad" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                <div id="suggestionsCiudad"></div>
            </div>

            @if(!empty($query))
                <div class="text-center mt-2">
                    <span class="search-stats-ciudad">
                        <i class="fas fa-filter me-1"></i>
                        Resultados para: <strong>{{ $query }}</strong>
                        &nbsp;·&nbsp;
                        <a href="{{ route('ciudad', $ciudad->id) }}"
                           style="color:var(--accent); font-weight:700">Limpiar</a>
                    </span>
                </div>
            @endif
        </form>
    </div>
</div>

<section class="empresas-ciudad-section">
    <div class="container">
        @if($empresas->isNotEmpty())
            <div class="row g-3">
                @foreach($empresas as $empresa)
                    <div class="col-12 col-md-6">
                        <div class="empresa-ciudad-card">
                            <div class="empresa-ciudad-img-wrap">
                                @if($empresa->imagen)
                                    <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                                         alt="{{ $empresa->nombre }}">
                                @else
                                    <div class="empresa-ciudad-img-placeholder">
                                        <i class="fas fa-store"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="empresa-ciudad-body">
                                
                                <div>
                                    <h5>{{ $empresa->nombre }}</h5>
                                    @if($empresa->descuento)
                                        <span class="badge-desc-ciudad">{{ $empresa->descuento }}</span>
                                    @endif
                                    @if($empresa->descripcion)
                                        <p class="empresa-desc">{{ $empresa->descripcion }}</p>
                                    @endif
                                </div>

                                <div class="empresa-ciudad-footer">
                                    <div class="empresa-contacto-ciudad">
                                        @if($empresa->facebook)
                                            <a href="{{ $empresa->facebook }}" class="btn-cont btn-cont-fb" target="_blank" title="Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        @endif
                                        @if($empresa->email)
                                            <a href="mailto:{{ $empresa->email }}" class="btn-cont btn-cont-mail" title="Correo">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                        @endif
                                        @if($empresa->web)
                                            <a href="{{ $empresa->web }}" class="btn-cont btn-cont-web" target="_blank" title="Sitio web">
                                                <i class="fas fa-globe"></i>
                                            </a>
                                        @endif
                                        @if($empresa->celular)
                                            <a href="https://api.whatsapp.com/send?phone=591{{ $empresa->celular }}&text=Hola!%20Vi%20su%20empresa%20en%20FaceBol%20y%20quiero%20más%20información."
                                               class="btn-cont btn-cont-wa" target="_blank" title="WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif
                                    </div>

                                    <a href="{{ route('detalleEmpresa', $empresa->slug) }}"
                                       class="btn-ver-empresa">
                                        Ver empresa <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
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
            <div class="empty-state-ciudad">
                <i class="fas fa-store-slash"></i>
                <h4>Sin empresa mencionada en {{ $ciudad->nombre }}</h4>
                <p>No se encontraron empresas en esta ciudad. ¡Pronto habrá novedades!</p>
                <a href="{{ route('ciudad', ['id' => request()->route('id')]) }}" class="btn-ver-mas d-inline-block mt-3" style="max-width:220px">
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
    <script src="{{ asset('js/ciudad.js') }}"></script>
@endpush

@endsection
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
            <h1>{{ $nombreCiudad }}</h1>
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
                    <span>{{ $totalEmpresas }} {{ $totalEmpresas === 1 ? 'empresa' : 'empresas' }} en {{ $nombreCiudad }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="buscador-ciudad">
    <div class="container">
        <form method="GET" action="{{ request()->url() }}">
            <div class="input-group">
                <input type="text"
                       name="q"
                       class="form-control"
                       placeholder="Buscar empresa en {{ $nombreCiudad }}..."
                       value="{{ request('q') }}">
                <button class="btn-buscar-ciudad" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<section class="empresas-ciudad-section">
    <div class="container">

        @if($todasLasEmpresas->isNotEmpty())
            <div class="row g-3">
                @foreach($todasLasEmpresas as $empresa)
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

            @if(method_exists($empresas1, 'hasPages') && $empresas1->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $empresas1->appends(request()->query())->links() }}
                </div>
            @endif

        @else
            <div class="empty-state-ciudad">
                <i class="fas fa-map-marker-slash"></i>
                <h4>Sin empresas en {{ $nombreCiudad }}</h4>
                <p>Aún no hay empresas registradas en esta ciudad. ¡Pronto habrá novedades!</p>
                <a href="{{ route('empresa') }}"
                   class="btn-ver-empresa d-inline-block mt-3">
                    Ver todas las empresas
                </a>
            </div>
        @endif

    </div>
</section>

@endsection
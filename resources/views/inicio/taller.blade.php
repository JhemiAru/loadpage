@extends('inicio.template')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/taller.css') }}">
@endpush

@section('content')

<section class="talleres-header">
    <div class="container">
        <h1><i class="fas fa-chalkboard-teacher me-2" style="color: var(--accent)"></i>Talleres</h1>
        <p class="subtitle">
            Capacítate con nuestros talleres prácticos y obtén certificado de participación.
        </p>
    </div>
</section>

@if($talleres->isNotEmpty())

    <section class="taller-destacado-section">
        <div class="container pb-4">
            <div class="mb-3 d-flex align-items-center gap-3">
                <h2 style="font-size:1.25rem; font-weight:700; color:var(--primary); margin:0">
                    <i class="fas fa-star me-2" style="color:var(--accent)"></i>Próximo Taller
                </h2>
            <span class="badge-estado {{ $reciente->esFuturo ? 'badge-proximo' : 'badge-pasado' }}">
                {{ $reciente->esFuturo ? 'Próximo' : 'Finalizado' }}
            </span>
            </div>
            <div class="taller-destacado-card">                
                @if($reciente->imagen)
                    <img src="{{ asset('imagen/talleres/' . $reciente->imagen) }}"
                         alt="{{ $reciente->titulo }}"
                         class="taller-destacado-img">
                @else
                    <div class="taller-destacado-img-placeholder">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                @endif
            
                <div class="taller-destacado-body">
                    <span class="badge-nuevo">✦ Más reciente</span>
                    <h2>{{ $reciente->titulo }}</h2>
                    <p class="descripcion-text">{{ $reciente->descripcion }}</p>

                    <div class="taller-meta">
                        <div class="taller-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $reciente->fecha_formateada }}</span>
                        </div>
                        <div class="taller-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ $reciente->horario }}</span>
                        </div>
                        <div class="taller-meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $reciente->lugar }}</span>
                        </div>
                        <div>
                            <span class="taller-costo-badge {{ $reciente->costo == 0 ? 'gratuito' : '' }}">
                                @if($reciente->costo == 0)
                                    <i class="fas fa-gift me-1"></i> Gratuito
                                @else
                                    <i class="fas fa-tag me-1"></i> Bs. {{ number_format($reciente->costo, 2) }}
                                @endif
                            </span>
                        </div>
                    </div>

                    @if(!empty($reciente->detalles_array))
                        <div class="taller-detalles-grid">
                            @foreach($labelDetalles as $key => $label)
                                @if(isset($reciente->detalles_array[$key]))
                                    <div class="detalle-chip">
                                        <span class="label">{{ $label }}</span>
                                        <span class="valor">{{ $reciente->detalles_array[$key] }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        @if($reciente->esFuturo)
                            <a href="https://api.whatsapp.com/send?phone=591{{ $institucion->celular }}&text=Hola!%20Quiero%20inscribirme%20al%20taller:%20{{ urlencode($reciente->titulo) }}"
                               class="btn-taller-detalle" target="_blank">
                                <i class="fab fa-whatsapp me-1"></i> Inscribirse
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($anteriores->isNotEmpty())
    <section class="talleres-anteriores-section">
        <div class="container">
            <h2><i class="fas fa-history me-2" style="color:var(--blue-light)"></i>Talleres anteriores</h2>
            <div class="row g-4">
                @foreach($anteriores as $taller)
                    <div class="col-md-6 col-lg-4">
                        <div class="taller-card">
                            <div class="taller-card-img-wrap">
                                @if($taller->imagen)
                                    <img src="{{ asset('imagen/talleres/' . $taller->imagen) }}"
                                         alt="{{ $taller->titulo }}">
                                @else
                                    <div class="taller-card-img-placeholder">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                @endif
                                <span class="taller-fecha-ribbon">
                                    {{ \Carbon\Carbon::parse($taller->fecha)->isoFormat('D MMM YYYY') }}
                                </span>
                            </div>
                            <div class="taller-card-body">
                                <h5>{{ $taller->titulo }}</h5>
                                <p class="desc">{{ $taller->descripcion }}</p>

                                <div class="taller-card-footer">
                                    <span class="taller-precio {{ $taller->costo == 0 ? 'gratuito' : '' }}">
                                        @if($taller->costo == 0)
                                            Gratuito
                                        @else
                                            Bs. {{ number_format($taller->costo, 2) }}
                                        @endif
                                    </span>
                                    <span class="badge-estado {{ $taller->esFuturo ? 'badge-proximo' : 'badge-pasado' }}">
                                        {{ $taller->esFuturo ? 'Próximo' : 'Finalizado' }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@else
    <section style="padding: 60px 0; background: var(--section-bg)">
        <div class="container">
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h4>No hay talleres disponibles por el momento.</h4>
                <p>Pronto anunciaremos nuevas fechas. ¡Mantente atento!</p>
            </div>
        </div>
    </section>
@endif

@endsection
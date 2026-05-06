@extends('template')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/actividad.css') }}">
@endpush

@section('content')
<div class="custom-container">
    
    <div class="hero-header">
        <h1>
            <i class="fas fa-calendar-alt me-2" style="color: var(--accent);"></i>
            {{$institucion->tituloactividades ?? 'Próximas Actividades'}}
        </h1>
        <div class="decoration-line"></div>
        <p class="hero-sub mt-3">
            {{$institucion->desactividades ?? 'Vive experiencias únicas, mantente al día con nuestros eventos'}}
        </p>
    </div>

    <div class="row g-4">
        @foreach($actividades as $index => $actividad)
        @if($actividad->tipo == 'actividad' && $actividad->activo == 1)
        <div class="col-12" style="animation-delay: {{ $loop->index * 0.05 }}s;">
            <div class="card-actividad-modern" data-id="{{ $actividad->id }}">
                <div class="row g-0 align-items-stretch">
                    <div class="col-md-3 col-lg-2">
                        <div class="fecha-modern h-100">
                            <div>
                                <span class="dia-numero">{{$actividad->dia}}</span>
                                <div class="mes-texto">{{$actividad->mes}}</div>
                                <div class="anio-texto">
                                    <i class="far fa-calendar-alt me-1"></i> {{$actividad->año}}
                                </div>
                            </div>
                            <div class="{{ $actividad->estado == 'Finalizado' ? 'estado-badge-f' : 'estado-badge-c' }}">{{ $actividad->estado }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-lg-10">
                        <div class="contenido-modern">
                            <div class="d-flex flex-wrap justify-content-between align-items-start">
                                <h3 class="actividad-titulo">
                                    <i class="fas fa-flag-checkered me-2" style="color: var(--accent); font-size: 1.3rem;"></i>
                                    {{$actividad->nombre}}
                                </h3>
                                <span class="badge-evento">
                                    <i class="far fa-clock me-1"></i> Evento especial
                                </span>
                            </div>

                            <div class="descripcion-container">
                                <div class="descripcion-corta @if($actividad->mostrarBotonLeer) collapsible @endif" id="desc-{{ $actividad->id }}">
                                    {!! $actividad->descripcion_corta !!}
                                </div>
                            </div>

                            @if($actividad->mostrarBotonLeer)
                            <button class="btn-leer" data-id="{{ $actividad->id }}" data-bs-toggle="modal" data-bs-target="#modalActividad-{{ $actividad->id }}">
                                Leer más <i class="fas fa-arrow-right"></i>
                            </button>
                            @endif

                            <div class="img-wrapper" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalActividad-{{ $actividad->id }}">
                                <img src="{{asset('imagen/actividades/'.$actividad->imagen)}}" 
                                     alt="Imagen de {{$actividad->nombre}}"
                                     class="actividad-img-modern"
                                     onerror="this.onerror=null; this.src='https://placehold.co/800x500/f0f0f0/ccc?text=Imagen+no+disponible';">
                            </div>

                            <div class="meta-tags">
                                <span class="meta-tag">
                                    <i class="fas fa-tag"></i>
                                    Cultural
                                </span>
                                <span class="meta-tag">
                                    <i class="fas fa-users"></i>
                                    Comunidad
                                </span>
                                <span class="meta-tag">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Presencial
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL -->        
        <div class="modal fade modal-modern" id="modalActividad-{{ $actividad->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $actividad->id }}" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="margin-top: 5vh; margin-bottom: 5vh;">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h4 class="modal-title fw-bold" id="modalLabel-{{ $actividad->id }}">
                                <i class="fas fa-calendar-alt me-2"></i>{{ $actividad->nombre }}
                            </h4>
                            <div class="modal-fecha-badge">
                                <i class="fas fa-calendar-day"></i>
                                <span>{{ $actividad->dia }} de {{ $actividad->mes }}, {{ $actividad->año }}</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="modal-imagen">
                            <img src="{{asset('imagen/actividades/'.$actividad->imagen)}}" 
                                 alt="{{$actividad->nombre}}"
                                 onerror="this.onerror=null; this.src='https://placehold.co/800x500/f0f0f0/ccc?text=Imagen+no+disponible';">
                        </div>
                        
                        <div class="descripcion-completa mt-3">
                            {!! $actividad->descripcion_limpia !!}
                        </div>
                        
                        <hr class="my-4">
                        <div class="row text-muted small">
                            <div class="col-md-6">
                                <i class="fas fa-map-marker-alt me-2" style="color: var(--accent);"></i> Evento presencial
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-clock me-2" style="color: var(--accent);"></i> Horario: Consultar disponibilidad
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Cerrar
                        </button>
                        <button type="button" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-share-alt"></i> Compartir
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif        
        @endforeach
    </div>

    @if(!$hasActive)
    <div class="empty-state-custom">
        <i class="fas fa-calendar-times"></i>
        <h4>No hay actividades disponibles</h4>
        <p>Pronto publicaremos nuevas experiencias para ti.</p>
    </div>
    @endif
</div>
@push('scripts')
    <script src="{{ asset('js/actividad.js') }}"></script>
@endpush
@endsection
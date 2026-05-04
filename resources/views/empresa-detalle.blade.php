@extends('template')

@push('styles') 
<link rel="stylesheet" href="{{ asset('css/empresa-detalle.css') }}">
@endpush

@section('content')
<div class="detalle-page">

    {{-- ── HERO ──────────────────────────────────────────── --}}
    <header class="hero-detalle">
        <div class="container">
            <div class="row align-items-center g-4">

                <div class="col-lg-6" data-aos="fade-right">
                    <span class="hero-badge">
                        <i class="fas fa-tag me-1"></i> {{ $empresa->descuento ?? 'Beneficio exclusivo' }}
                    </span>
                    <h1 class="business-name">
                        {{ strtoupper($empresa->nombre ?? 'Empresa') }}
                    </h1>
                    <p class="lead mb-4">
                        {{ $empresa->promocion ?? 'Descubre los beneficios y promociones exclusivas que esta empresa tiene para ti.' }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#info" class="btn-hero-primary">
                            <i class="fas fa-info-circle me-2"></i> Ver detalles
                        </a>
                        @if(isset($empresa->facebook))
                            <a href="{{ $empresa->facebook }}" class="btn-hero-outline" target="_blank">
                                <i class="fab fa-facebook-f me-2"></i> Seguir en Facebook
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6 text-center hero-img-wrapper" data-aos="zoom-in" data-aos-delay="150">
                    @if(isset($empresa->imagen1) && $empresa->imagen1)
                        <img src="{{ asset('imagen/empresasproductos/' . $empresa->imagen1) }}"
                             alt="{{ $empresa->nombre }}"
                             class="img-fluid">
                    @else
                        <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                             alt="{{ $empresa->nombre }}"
                             class="img-fluid">
                    @endif
                </div>

            </div>
        </div>

        {{-- Logo flotante solo en desktop --}}
        <div class="floating-logo-corner d-none d-md-flex">
            <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}" alt="{{ $empresa->nombre }}">
            <div>
                <p class="m-0 fw-bold small text-white">{{ $empresa->nombre }}</p>
                <p class="m-0 text-white-50" style="font-size: 0.7rem;">Empresa aliada FaceBol</p>
            </div>
        </div>
    </header>

    {{-- ── INFO + DATA ────────────────────────────────────── --}}
    <section class="detalle-section" id="info">
        <div class="container">
            <div class="row g-4">

                {{-- Descripción --}}
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="card-glass p-4 p-xl-5">
                        <span class="section-label"><i class="fas fa-building me-1"></i> Acerca de la empresa</span>
                        <h2 class="mt-2 mb-0" style="font-size: 1.6rem; color: var(--primary); font-weight: 700;">
                            {{ $empresa->nombre }}
                        </h2>
                        <div class="accent-divider"></div>
                        <p class="lh-lg" style="color: var(--text-muted);">
                            {!! $empresa->descripcion ?? 'Información sobre esta empresa próximamente.' !!}
                        </p>
                        <div class="row mt-3 g-3">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fas fa-medal fa-2x" style="color: var(--accent);"></i>
                                    <div>
                                        <strong>Calidad garantizada</strong><br>
                                        <small class="text-muted">Empresa verificada</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fas fa-clock fa-2x" style="color: var(--blue-light);"></i>
                                    <div>
                                        <strong>Horario de atención</strong><br>
                                        <small class="text-muted">{{ $empresa->horario ?? 'Consultar' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data ejecutiva --}}
                <div class="col-lg-5" data-aos="fade-left">
                    <div class="card-glass p-4 h-100 d-flex flex-column">
                        <span class="section-label"><i class="fas fa-chart-bar me-1"></i> Información</span>
                        <h4 class="mt-2 mb-3" style="color: var(--primary); font-weight: 700;">Datos de contacto</h4>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="info-chip"><i class="fas fa-tag"></i> {{ $empresa->descuento ?? 'Beneficio especial' }}</span>
                            @if($empresa->telefono)
                                <span class="info-chip"><i class="fas fa-phone-alt"></i> {{ $empresa->telefono }}</span>
                            @endif
                            @if(isset($empresa->ciudad))
                                <span class="info-chip"><i class="fas fa-map-pin"></i> {{ $empresa->ciudad->nombre }}</span>
                            @endif
                        </div>

                        <hr style="opacity: 0.2;">

                        {{-- <div class="mb-3">
                            <small class="text-muted d-block mb-1">Visitas registradas</small>
                            <span class="stat-number">{{ number_format($empresa->nvisitas ?? 0) }}</span>
                            <span class="text-muted ms-1">personas</span>
                        </div> --}}

                        <div class="mb-3">
                            <p class="mb-1">
                                <i class="fas fa-map-marker-alt me-2" style="color: var(--blue-light);"></i>
                                <strong>Dirección:</strong>
                            </p>
                            <p class="text-muted ps-4 mb-0">{{ $empresa->direccion ?? 'Disponible al contactar' }}</p>
                        </div>

                        @if(isset($empresa->facebook))
                            <a href="{{ $empresa->facebook }}" class="btn-outline-primary-custom mt-auto" target="_blank">
                                <i class="fab fa-facebook-f"></i> Ver en Facebook
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── MULTIMEDIA ─────────────────────────────────────── --}}
    <section class="detalle-section" id="media">
        <div class="container">
            <div class="text-center mb-4" data-aos="fade-up">
                <span class="section-label">Contenido</span>
                <h2 class="mt-1" style="color: var(--primary); font-weight: 700;">Video y Galería</h2>
                <div class="accent-divider mx-auto"></div>
            </div>

            <div class="row g-4">
                {{-- Video --}}
                <div class="col-md-6" data-aos="zoom-in">
                    <div class="media-frame">
                        <div class="inner">
                            <h5 class="fw-semibold mb-3" style="color: var(--primary);">
                                <i class="fab fa-youtube me-2 text-danger"></i> Video promocional
                            </h5>
                            @if(isset($empresa->video) && $empresa->video)
                                <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                                    <iframe src="https://www.youtube.com/embed/{{ $empresa->video }}"
                                            title="Video de {{ $empresa->nombre }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen
                                            loading="lazy"></iframe>
                                </div>
                            @elseif(isset($empresa->videof) && $empresa->videof)
                                <div class="bg-light rounded-3 p-5 text-center">
                                    <i class="fab fa-facebook-f fa-3x mb-3" style="color: #1877f2;"></i>
                                    <p class="mb-0">
                                        Video en Facebook:
                                        <a href="{{ $empresa->videof }}" target="_blank" class="fw-bold" style="color: var(--primary);">
                                            Ver ahora <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </p>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-3" style="height: 220px;">
                                    <div class="text-center text-muted">
                                        <i class="fas fa-play-circle fa-3x mb-2 d-block"></i>
                                        Material en producción
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Galería --}}
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="media-frame">
                        <div class="inner">
                            <h5 class="fw-semibold mb-3" style="color: var(--primary);">
                                <i class="fas fa-camera me-2" style="color: var(--blue-light);"></i> Galería
                            </h5>
                            @if(isset($empresa->imagen1) && $empresa->imagen1)
                                <a href="{{ asset('imagen/empresasproductos/' . $empresa->imagen1) }}" target="_blank">
                                    <img src="{{ asset('imagen/empresasproductos/' . $empresa->imagen1) }}"
                                         alt="{{ $empresa->nombre }}"
                                         class="img-fluid w-100 rounded-3"
                                         style="height: 220px; object-fit: cover;"
                                         loading="lazy">
                                </a>
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-3" style="height: 220px;">
                                    <div class="text-center text-muted">
                                        <i class="fas fa-image fa-3x mb-2 d-block"></i>
                                        Sin imagen disponible
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── UBICACIÓN ───────────────────────────────────────── --}}
    <section class="detalle-section" id="location">
        <div class="container">
            <div class="mapa-card" data-aos="fade-up">
                <div class="row g-0">

                    <div class="col-md-5 mapa-info d-flex flex-column justify-content-center">
                        <i class="fas fa-location-dot fa-2x mb-3"></i>
                        <h4 style="color: var(--primary); font-weight: 700;">Ubicación</h4>
                        <p class="text-muted small">Visítenos en nuestras instalaciones.</p>
                        <hr style="opacity: 0.15;">
                        <p class="mb-2">
                            <i class="fas fa-clock me-2"></i>
                            <strong>Horario:</strong> {{ $empresa->horario ?? 'Consultar' }}
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-building me-2"></i>
                            {{ $empresa->direccion ?? 'Dirección no disponible' }}
                        </p>
                    </div>

                    <div class="col-md-7 p-0">
                        @if(isset($empresa->mapa) && $empresa->mapa)
                            <iframe src="https://www.google.com/maps/embed?pb={{ $empresa->mapa }}"
                                    width="100%"
                                    height="320"
                                    frameborder="0"
                                    style="border:0; display:block;"
                                    allowfullscreen
                                    loading="lazy"></iframe>
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light" style="height: 320px;">
                                <div class="text-center text-muted p-4">
                                    <i class="fas fa-map fa-3x mb-2 d-block"></i>
                                    Mapa próximamente disponible
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ── CONTACTO ────────────────────────────────────────── --}}
    <section class="detalle-section" id="contact">
        <div class="container">
            <div class="row g-4">

                <div class="col-md-6" data-aos="fade-right">
                    <div class="card-glass p-4 h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <i class="fas fa-envelope-open-text fa-2x" style="color: var(--blue-light);"></i>
                            <h5 class="fw-bold mb-0" style="color: var(--primary);">Información de contacto</h5>
                        </div>
                        <p class="text-muted">¿Desea información adicional? Contáctese directamente con la empresa.</p>
                        <div class="mt-3">
                            @if($empresa->telefono)
                                <div class="mb-2">
                                    <i class="fas fa-phone-alt me-3" style="color: var(--blue-light);"></i>
                                    {{ $empresa->telefono }}
                                </div>
                            @endif
                            @if(isset($empresa->ciudad))
                                <div>
                                    <i class="fas fa-map-marker-alt me-3" style="color: var(--blue-light);"></i>
                                    {{ $empresa->ciudad->nombre ?? '' }} — {{ $empresa->direccion ?? '' }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-left">
                    <div class="card-glass p-4 h-100 text-center d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-handshake fa-3x mb-3" style="color: var(--accent);"></i>
                        <h5 class="fw-bold" style="color: var(--primary);">Seguir a {{ $empresa->nombre }}</h5>
                        <p class="text-muted small mb-3">
                            {{ number_format($empresa->nvisitas ?? 0) }} personas ya visitaron esta empresa.
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            @if(isset($empresa->facebook) && $empresa->facebook)
                                <a href="{{ $empresa->facebook }}" class="social-btn fb" target="_blank" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if(isset($empresa->telefono) && $empresa->telefono)
                                <a href="https://api.whatsapp.com/send?phone=591{{ preg_replace('/\D/', '', $empresa->telefono) }}&text=Hola!%20Vi%20su%20empresa%20en%20FaceBol%20y%20quiero%20más%20información."
                                   class="social-btn wa" target="_blank" title="WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            @endif
                            @if(isset($empresa->instagram) && $empresa->instagram)
                                <a href="{{ $empresa->instagram }}" class="social-btn ig" target="_blank" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 650, once: true, offset: 20 });

    // Scroll suave a secciones
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const id = this.getAttribute('href');
            if (id.length > 1) {
                const el = document.querySelector(id);
                if (el) {
                    e.preventDefault();
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
</script>
@endpush
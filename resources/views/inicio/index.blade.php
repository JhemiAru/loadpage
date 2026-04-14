@extends('inicio.template')
@section('title', 'Inicio - FaceBol')
@section('carousel-content')
<!-- Slide 1 -->
<div class="carousel-item active">
    <div class="hero-slide">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-4 d-flex justify-content-center">
                    <img src="{{ asset('imagen/institucion/descuentos.png') }}" alt="" class="carousel-img">
                </div>
                <div class="col-lg-8">
                    <h1 class="hero-title">
                        {!! $institucion->titulosomos ?? 'Empresa dedicada al marketing' !!}<br>
                        publicidad y <span class="highlight2">emprendimiento</span>
                    </h1>
                    <p class="hero-sub">
                        {!! $institucion->qSomos ?? 'Desarrolla tu pasantía/práctica profesional con nosotros.' !!}<br>
                        <strong>Adquiere nuestra tarjeta para obtener descuentos y promociones</strong>
                    </p>
                    <div class="d-flex gap-3 flex-wrap mt-3">
                        <a href="#" class="btn btn-conocenos">Conócenos</a>
                        <a href="#" class="btn btn-beneficios">Ver beneficios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Slide 2 -->
<div class="carousel-item">
    <div class="hero-slide">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-4 d-flex justify-content-center">
                    <img src="https://picsum.photos/400/400?random=2" class="carousel-img">
                </div>
                <div class="col-lg-8">
                    <h1 class="hero-title">Impulsa tu <span class="highlight">negocio</span><br>con nosotros</h1>
                    <p class="hero-sub">Somos la institución número 1 en emprendimiento y la empresa más grande de publicidad en Bolivia.</p>
                    <div class="d-flex gap-3 flex-wrap mt-3">
                        <a href="#" class="btn btn-conocenos">Conócenos</a>
                        <a href="#" class="btn btn-beneficios">Ver beneficios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Slide 3 -->
<div class="carousel-item">
    <div class="hero-slide">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-4 d-flex justify-content-center">
                    <img src="https://picsum.photos/400/400?random=3" class="carousel-img">
                </div>
                <div class="col-lg-8">
                    <h1 class="hero-title">Más de <span class="highlight">{{ $countEmpresas }} empresas</span><br>con beneficios exclusivos</h1>
                    <p class="hero-sub">Obtén descuentos, promociones y accede a eventos privados con nuestra tarjeta FaceBol.</p>
                    <div class="d-flex gap-3 flex-wrap mt-3">
                        <a href="#" class="btn btn-conocenos">Solicitar tarjeta</a>
                        <a href="#" class="btn btn-beneficios">Ver beneficios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- FEATURES SECTION -->
<section class="features-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5>Pasantías y Prácticas Profesionales</h5>
                    <p>Aceptamos pasantes en áreas de: contabilidad, marketing, sistemas, comercio, administración, etc.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5>Apoyo a emprendedores</h5>
                    <p>Somos la institución número 1 en emprendimiento y la empresa más grande de publicidad en Bolivia.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h5>Tarjeta de descuento</h5>
                    <p>Con nuestra tarjeta de descuento puedes conseguir promociones en más de {{ $countEmpresas }} empresas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PARTNERS SECTION -->
<section class="partners-section">
    <div class="container">
        <h2>Beneficios en las empresas:</h2>
        <div class="row g-3 part">
            @foreach($empresas->take(12) as $empresa)
            <div class="col-6 col-sm-4 col-md-3 col-lg">
                <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}" alt="" class="img-fluid img-thumbnail">
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CARD CTA SECTION -->
<section class="card-cta-section">
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 text-center">                                
                <img src="{{ asset('imagen/institucion/tarjeta.webp') }}" alt="" class="img-fluid">                
            </div>
            <div class="col-lg-7">
                <div class="cta-box">
                    <h3>Adquiera nuestra <span class="highlight">tarjeta</span> ya<br>mismo y disfrute los <span class="highlight2">beneficios</span></h3>
                </div>
                <div class="mt-2">
                    <div class="cta-check"><i class="fas fa-check-circle"></i> Descuentos en más de <strong>{{ $countEmpresas }} empresas</strong></div>
                    <div class="cta-check"><i class="fas fa-check-circle"></i> Promociones exclusivas</div>
                    <div class="cta-check"><i class="fas fa-check-circle"></i> Ofertas y eventos privados.</div>
                </div>
                <a href="#" class="btn btn-solicitar mt-3">Solicitar tarjeta</a>
            </div>
        </div>
    </div>
</section>

<!-- MISSION / VISION SECTION -->
<section class="mission-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Columna izquierda: Misión y Visión (Sin cambios) -->
            <div class="col-lg-5">
                <div class="text-center mb-3"><span class="badge-mission">Misión</span></div>
                <div class="mv-box">{{ $institucion->mision ?? '...' }}</div>
                <div class="text-center mb-3"><span class="badge-vision">Visión</span></div>
                <div class="mv-box vision-box">{{ $institucion->vision ?? '...' }}</div>
            </div>

            <!-- Columna derecha: Carrusel Estilo "Focus Center" -->
            <div class="col-lg-7">
                <h2 class="allies-title text-center mb-4">Instituciones Aliadas</h2>
                
                <div id="alliesCarousel" class="carousel slide allies-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $aliados = $empresas->where('aliadas', 1)->where('activo', 1)->values();
                            $total = $aliados->count();
                        @endphp

                        @foreach($aliados as $index => $empresa)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="carousel-custom-container">
                                @php 
                                    $prev = ($index - 1 + $total) % $total; 
                                    $next = ($index + 1) % $total;
                                @endphp
                                
                                <div class="side-peek left-peek">
                                    <img src="{{ asset('imagen/empresas/' . $aliados[$prev]->imagen) }}" alt="">
                                </div>
                                
                                <div class="main-focus-card" onclick="window.location='{{ route('detalleEmpresa', $empresa->slug) }}'">
                                    <div class="inner-card">
                                        <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}" alt="{{ $empresa->nombre }}">
                                    </div>
                                </div>
                                
                                <div class="side-peek right-peek">
                                    <img src="{{ asset('imagen/empresas/' . $aliados[$next]->imagen) }}" alt="">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Controles con mayor visibilidad -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#alliesCarousel" data-bs-slide="prev">
                        <span class="nav-btn"><i class="fas fa-chevron-left"></i></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#alliesCarousel" data-bs-slide="next">
                        <span class="nav-btn"><i class="fas fa-chevron-right"></i></span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
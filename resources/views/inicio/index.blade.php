@extends('inicio.template')
@section('title', 'Inicio - FaceBol')

@section('hero-carousel')
<div class="hero-carousel-container">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero-slide">
                    <div class="container">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-4 d-flex justify-content-center">
                                <img src="{{ asset('imagen/institucion/descuentos.png') }}" alt="" class="carousel-img">
                            </div>
                            <div class="col-lg-8">
                                <h1 class="hero-title">Impulsa tu <span class="highlight">negocio</span><br>con nosotros </h1>
                                <p class="hero-sub">Somos la institución número 1 en emprendimiento y la empresa más grande de publicidad en Bolivia.</p>
                                <div class="d-flex gap-3 flex-wrap mt-3">
                                    <button href="#" class="btn btn-conocenos">Conócenos</button>
                                    <button href="#" class="btn btn-beneficios">Ver beneficios</button>
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
                                    <button href="#" class="btn btn-conocenos">Conócenos</button>
                                    <button href="#" class="btn btn-beneficios">Ver beneficios</button>
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
                                <h1 class="hero-title">Taller de <span class="highlight">Hacking Ético</span><br>este 24 de abril</h1>
                                <p class="hero-sub">Aprende sobre los fundamentos del hacking ético y cómo proteger tus sistemas.</p>
                                <div class="d-flex gap-3 flex-wrap mt-3">
                                    <button href="#" class="btn btn-beneficios">Ver beneficios</button>
                                    <button href="#" class="btn btn-conocenos">Solicitar tarjeta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="custom-arrow">
                <i class="fas fa-chevron-left"></i>
            </span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="custom-arrow">
                <i class="fas fa-chevron-right"></i>
            </span>
        </button>
    </div>
</div>
@endsection

@section('content')
<!-- Slider Empresas -->
<section class="partners-section">
    <div class="container-fluid"> <h2 class="text-center mb-5">Beneficios en las empresas:</h2>
        
        <div class="logos-slider">
            <div class="logos-track">
                {{-- Bloque Original --}}
                @foreach($empresas as $empresa)
                    @if($empresa->destacado==1)
                        <div class="logo-item">
                            <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}" alt="{{ $empresa->nombre }}">
                        </div>
                    @endif
                @endforeach

                {{-- Bloque Duplicado (Espejo para el efecto infinito) --}}
                @foreach($empresas as $empresa)
                    @if($empresa->destacado==1)
                        <div class="logo-item">
                            <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}" alt="{{ $empresa->nombre }}">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Tarjetas de presentacion -->
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

<!-- Tarjeta FaceBol -->
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

<!-- Mision - Vision / Carrusel Instituciones -->
<section class="mission-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="text-center mb-3"><span class="badge-mission">Misión</span></div>
                <div class="mv-box">{{ $institucion->mision ?? '...' }}</div>
                <div class="text-center mb-3"><span class="badge-vision">Visión</span></div>
                <div class="mv-box vision-box">{{ $institucion->vision ?? '...' }}</div>
            </div>

            <div class="col-lg-7">
                <h2 class="allies-title text-center mb-4">Instituciones Aliadas</h2>
                
                <div id="alliesCarousel" class="carousel slide allies-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner" style="padding-bottom: 40px">
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
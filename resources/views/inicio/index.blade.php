@extends('inicio.layout')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush
@section('content')

{{-- SLIDER DE LOGOS --}}
<section class="partners-section">
    <div class="container-fluid">
        <h2>Una red de beneficios en constante crecimiento</h2>
        <p class="subtitle">
            Únete a la comunidad que ya disfruta de descuentos y promociones
            en más de {{ $countEmpresas }} establecimientos aliados.
        </p>

        <div class="logos-slider">
            <div class="logos-track">

                @foreach($empresasSlider as $empresa)
                    <div class="logo-item">
                        <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                             alt="{{ $empresa->nombre }}"
                             width="160" height="90"
                             decoding="async">
                    </div>
                @endforeach

                @foreach($empresasSlider as $empresa)
                    <div class="logo-item" aria-hidden="true">
                        <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                             alt=""
                             width="160" height="90"
                             loading="lazy"
                             decoding="async">
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

{{-- SECCIÓN DE CATEGORÍAS --}}
<section class="categorias-section">
    <div class="container">
        <h2>Explora por Categorías</h2>
        <p class="subtitle">
            Encuentra los mejores descuentos y beneficios en tus rubros favoritos
        </p>
        <div class="categoria-grid" id="categoriaGrid">
            @foreach($categorias as $categoria)
                <a href="{{ route('categoria', $categoria->slug) }}" class="categoria-card cat-item">
                    <div class="categoria-icon">
                        <i class="{{ $categoria->icono ?? 'fas fa-tag' }}"></i>
                    </div>
                    <h4 class="categoria-nombre">{{ $categoria->nombre }}</h4>
                </a>
            @endforeach
            <button class="categoria-card cat-toggle" id="btnToggleCategorias" style="display:none;">
                <div class="categoria-icon cat-toggle-icon">
                    <i class="fas fa-plus" id="toggleIcon"></i>
                </div>
                <h4 class="categoria-nombre" id="toggleText">Ver más</h4>
            </button>
        </div>
    </div>
</section>

{{-- FEATURES --}}
<section class="features-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4" style="padding-bottom: 10px">
                <div class="feature-card">
                    <div class="feature-header">
                        <div class="feature-icon"><i class="fas fa-users"></i></div>
                        <h5>Pasantías y Prácticas Profesionales</h5>
                    </div>
                    <p>Aceptamos pasantes en áreas de: contabilidad, marketing, sistemas, comercio, entre otros.</p>
                </div>
            </div>
            <div class="col-md-4" style="padding-bottom: 10px">
                <div class="feature-card">
                    <div class="feature-header">
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <h5>Apoyo a emprendedores</h5>
                    </div>
                    <p>Somos la institución número 1 en emprendimiento y la empresa más grande de publicidad en Bolivia.</p>
                </div>
            </div>
            <div class="col-md-4" style="padding-bottom: 10px">
                <div class="feature-card">
                    <div class="feature-header">
                        <div class="feature-icon"><i class="fas fa-credit-card"></i></div>
                        <h5>Tarjeta de descuento</h5>
                    </div>
                    <p>Con nuestra tarjeta de descuento puedes conseguir promociones en más de {{ $countEmpresas }} empresas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA TARJETA --}}
<section class="card-cta-section">
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 text-center">
                <img src="{{ asset('imagen/institucion/tarjeta.webp') }}"
                     alt="Tarjeta FaceBol"
                     class="img-fluid"
                     loading="lazy"
                     style="border-radius: 17px">
            </div>
            <div class="col-lg-7">
                <div class="cta-box">
                    <h3>Adquiera nuestra <span class="highlight">tarjeta</span> ya<br>
                        mismo y disfrute los <span class="highlight2">beneficios</span></h3>
                </div>
                <div class="mt-2">
                    <div class="cta-check"><i class="fas fa-check-circle"></i> Descuentos en más de <strong>{{ $countEmpresas }} empresas</strong></div>
                    <div class="cta-check"><i class="fas fa-check-circle"></i> Promociones exclusivas.</div>
                    <div class="cta-check"><i class="fas fa-check-circle"></i> Ofertas y descuentos tipo 2x1, -10%, -20% y más.</div>
                </div>
                <a href="https://api.whatsapp.com/send?phone=591{{ $institucion->celular2 }}&text=Hola!%20Quiero%20más%20información%20sobre%20la%20tarjeta%20FaceBol."
                    class="btn btn-2" target="_blank">Solicitar tarjeta</a>
            </div>
        </div>
    </div>
</section>

{{-- MISIÓN/VISIÓN + CARRUSEL ALIADAS --}}
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

                @php
                    $aliados = $empresasAliadas;
                    $total   = $aliados->count();
                @endphp

                @if($total > 0)
                <div id="alliesCarousel" class="carousel slide allies-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner" style="padding-bottom: 40px">

                        @foreach($aliados as $index => $empresa)
                        @php
                            $prev = ($index - 1 + $total) % $total;
                            $next = ($index + 1) % $total;
                            $isFirst = $loop->first;
                        @endphp
                        <div class="carousel-item {{ $isFirst ? 'active' : '' }}">
                            <div class="carousel-custom-container">

                                <div class="side-peek left-peek">
                                    <img src="{{ asset('imagen/empresas/' . $aliados[$prev]->imagen) }}"
                                         alt=""
                                         width="120" height="120"
                                         {{ $isFirst ? '' : 'loading="lazy"' }}
                                         decoding="async">
                                </div>

                                <div class="main-focus-card"
                                     onclick="window.location='{{ route('detalleEmpresa', $empresa->slug) }}'">
                                    <div class="inner-card">
                                        <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                                             alt="{{ $empresa->nombre }}"
                                             width="200" height="200"
                                             {{ $isFirst ? 'fetchpriority="high"' : 'loading="lazy"' }}
                                             decoding="async">
                                    </div>
                                </div>

                                <div class="side-peek right-peek">
                                    <img src="{{ asset('imagen/empresas/' . $aliados[$next]->imagen) }}"
                                         alt=""
                                         width="120" height="120"
                                         {{ $isFirst ? '' : 'loading="lazy"' }}
                                         decoding="async">
                                </div>

                            </div>
                        </div>
                        @endforeach

                    </div>

                    <button class="carousel-control-prev" type="button"
                            data-bs-target="#alliesCarousel" data-bs-slide="prev">
                        <span class="nav-btn"><i class="fas fa-chevron-left"></i></span>
                    </button>
                    <button class="carousel-control-next" type="button"
                            data-bs-target="#alliesCarousel" data-bs-slide="next">
                        <span class="nav-btn"><i class="fas fa-chevron-right"></i></span>
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/categoria_index.js') }}"></script>
@endpush

@endsection
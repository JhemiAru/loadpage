@extends('inicio.template')
@section('title', 'Inicio - FaceBol')
@section('carousel-content')
<!-- Slide 1 -->
<div class="carousel-item active">
    <div class="hero-slide">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-4 d-flex justify-content-center">
                    <img src="{{ asset('imagen/institucion/descuentos.png') }}" alt="" class="img-fluid img-thumbnail">
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
        <div class="row g-3">
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
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="text-center mb-3">
                    <span class="badge-mission">Misión</span>
                </div>
                <div class="mv-box">
                    {{ $institucion->mision ?? 'Formar emprendedores, apoyar el emprendimiento e impulsar la educación financiera en Bolivia' }}
                </div>
                <div class="text-center mb-3">
                    <span class="badge-vision">Visión</span>
                </div>
                <div class="mv-box vision-box">
                    {{ $institucion->vision ?? 'Ser una empresa reconocida a nivel nacional e internacional en creación de oportunidades, en el ámbito del emprendimiento y marcar un aporte significativo en bien de la sociedad.' }}
                </div>
            </div>
            <div class="col-lg-7">
                <h3 class="allies-title text-center">Instituciones aliadas:</h3>
                <div class="row g-3">
                    @php $aliadas = $empresas->where('aliadas', 1)->take(4); @endphp
                    @forelse($aliadas as $aliada)
                    <div class="col-6">
                        <div class="ally-card">
                            <div class="ally-name">{{ Str::limit($aliada->nombre, 25) }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="ally-card">
                            <div class="ally-name">Próximamente más aliados</div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
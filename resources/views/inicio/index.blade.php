@extends('inicio.template')
@section('title', 'Inicio - FaceBol')
@section('content')
<!-- HERO CAROUSEL -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators" style="bottom:16px;">
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
                            <div class="hero-promo-card">
                                <div class="badge-30">30%</div>
                                <div class="badge-20">20%</div>
                                <div style="margin-top:22px;">
                                    <div class="promo-label">PROMOCIONES</div>
                                </div>
                            </div>
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
        <div class="carousel-item">
            <div class="hero-slide">
                <div class="container">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <h1 class="hero-title">Más de <span class="highlight">200 empresas</span><br>con beneficios exclusivos</h1>
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
    </div>
</div>

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

<!-- STATS SECTION (Los contadores que ya tenías) -->
<section class="features-section" style="padding-top: 0;">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h5>{{ number_format($institucion->visitas + 70000) }}</h5>
                    <p>Visitas totales</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h5>{{ $countEmpresas }}</h5>
                    <p>Empresas afiliadas</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5>{{ number_format($countUsers + 3200) }}</h5>
                    <p>Personas afiliadas</p>
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
                <div class="partner-logo" style="background: linear-gradient(135deg, #{{ substr(md5($empresa->id), 0, 6) }}, #{{ substr(md5($empresa->id . '2'), 0, 6) }});">
                    <span style="color:#fff; font-size: 0.8rem; text-align: center;">{{ $empresa->nombre }}</span>
                </div>
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
                <div style="max-width:320px;margin:0 auto;background:linear-gradient(135deg,#1a3a6b 0%,#2e6bc4 40%,#f5a623 100%);border-radius:20px;padding:28px 26px 22px;box-shadow:0 20px 60px rgba(0,0,0,.5);">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:30px;">
                        <div style="background:#fff;border-radius:8px;width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
                            <span style="font-family:\'Poppins\',sans-serif;font-weight:900;color:#1a3a6b;font-size:.9rem;">F</span>
                        </div>
                        <div style="color:#fff;font-family:\'Poppins\',sans-serif;font-weight:800;">FaceBol</div>
                    </div>
                    <div style="color:rgba(255,255,255,.7);font-size:.7rem;letter-spacing:2px;margin-bottom:6px;">TARJETA MIEMBRO</div>
                    <div style="color:#fff;font-family:\'Poppins\',sans-serif;font-size:1.15rem;letter-spacing:3px;margin-bottom:20px;">1234 5678 9012</div>
                    <div style="display:flex;justify-content:space-between;">
                        <div>
                            <div style="color:rgba(255,255,255,.6);font-size:.65rem;">TITULAR</div>
                            <div style="color:#fff;font-size:.85rem;font-weight:700;">{{ auth()->user()->nombre ?? 'Tu Nombre' }}</div>
                        </div>
                    </div>
                </div>
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
                    {{ $institucion->vision ?? 'Ser una empresa reconocida a nivel nacional e internacional en creación de oportunidades' }}
                </div>
            </div>
            <div class="col-lg-7">
                <h3 class="allies-title text-center">Instituciones aliadas:</h3>
                <div class="row g-3">
                    @php $aliadas = $empresas->where('aliadas', 1)->take(4); @endphp
                    @forelse($aliadas as $aliada)
                    <div class="col-6">
                        <div class="ally-card" style="background: #000; border-radius: 16px; padding: 30px 24px; text-align: center; height: 130px;">
                            <div class="ally-name" style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 1.4rem; color: #fff;">{{ $aliada->nombre }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="ally-card" style="background: #000; border-radius: 16px; padding: 30px; text-align: center;">
                            <div class="ally-name" style="color: #fff;">Próximamente más aliados</div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('template')
@section('content')
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(145deg, #eef2f9 0%, #e0e6f0 100%);
      color: #1a2634;
      scroll-behavior: smooth;
      position: relative;
    }

    /* MARCA DE AGUA FORMAL Y SUTIL (Facebol) */
    body::before {
      content: "F A C E B O L";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      font-size: 8vw;
      font-weight: 800;
      font-family: 'Playfair Display', serif;
      color: rgba(226, 228, 231, 0.848);
      text-transform: uppercase;
      letter-spacing: 0.35em;
      display: flex;
      align-items: center;
      justify-content: center;
      pointer-events: none;
      z-index: 0;
      white-space: pre-wrap;
      text-align: center;
      transform: rotate(-10deg) scale(1.2);
      text-shadow: 2px 2px 12px rgba(240, 229, 229, 0.879);
      backdrop-filter: blur(1px);
    }

    /* segunda marca decorativa */
    body::after {
      content: "◈  CORPORATE  ◈";
      position: fixed;
      bottom: 3%;
      right: 3%;
      font-size: 2rem;
      font-weight: 400;
      color: rgba(45, 85, 125, 0.06);
      pointer-events: none;
      z-index: 0;
      font-family: 'Playfair Display', serif;
      opacity: 0.7;
      transform: rotate(-2deg);
      letter-spacing: 3px;
    }

    /* contenedor principal sobre marca */
    .ms-site-container {
      position: relative;
      z-index: 2;
      background: transparent;
    }

    /* Preloader */
    .ms-preload {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #eef2f9;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.6s ease;
    }
    .spinner-ring {
      width: 56px;
      height: 56px;
      border: 2px solid rgba(214, 219, 224, 0.989);
      border-top: 2px solid #2d557d;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }
    @keyframes spin {
      0% { transform: rotate(0deg);}
      100% { transform: rotate(360deg);}
    }

    /* Navbar con Glassmorphism elegante */
    .navbar-glass {
      background: rgba(255, 255, 255, 0.58);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(45, 85, 125, 0.2);
      box-shadow: 0 4px 20px rgba(75, 142, 235, 0.852);
      padding: 0.9rem 0;
    }
    .navbar-glass .navbar-brand {
      font-family: 'Playfair Display', serif;
      font-weight: 800;
      font-size: 1.8rem;
      background: linear-gradient(135deg, #1e3a5f, #2d557d);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      letter-spacing: -0.3px;
    }
    .navbar-glass .nav-link {
      color: #1e3a5f !important;
      font-weight: 600;
      margin: 0 0.7rem;
      font-size: 0.9rem;
      transition: 0.2s;
      position: relative;
    }
    .navbar-glass .nav-link:hover {
      background: linear-gradient(135deg, #1e3a5f, #2d557d);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
    }
    .navbar-glass .nav-link:after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 0%;
      height: 2px;
      background: linear-gradient(90deg, #1e3a5f, #5f8bb3);
      transition: 0.25s;
    }
    .navbar-glass .nav-link:hover:after {
      width: 100%;
    }

    /* Hero Glassmorphism principal */
    
  .hero-modern {
    background: radial-gradient(circle at 70% 30%, #5d44cc 0%, #2d1b6b 100%);
    min-height: 85vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    padding: 80px 0;
    color: white;
  }

  /* Brillo decorativo de fondo */
  .hero-modern::before {
    content: "";
    position: absolute;
    width: 600px;
    height: 600px;
    background: rgba(167, 139, 250, 0.15);
    filter: blur(100px);
    border-radius: 50%;
    top: -10%;
    left: -10%;
  }

  .business-name {
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -2px;
    margin-bottom: 20px;
    background: linear-gradient(to right, #ffffff, #e0d7ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  /* Imagen del producto (flotante) */
  .product-showcase {
    position: relative;
    z-index: 5;
    transition: transform 0.5s ease;
  }

  .product-showcase img {
    max-height: 450px;
    filter: drop-shadow(0 30px 50px rgba(0,0,0,0.4));
    transform: perspective(1000px) rotateY(-10deg);
  }

  /* Logo en la esquina inferior derecha */
  .floating-logo-corner {
    position: absolute;
    bottom: 30px;
    right: 40px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 15px;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 10;
  }

  .floating-logo-corner img {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    object-fit: cover;
  }

  .hero-badge {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 6px 16px;
    border-radius: 100px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #d1c4ff;
    display: inline-block;
  }

  .btn-modern {
    background: #ffffff;
    color: #2d1b6b;
    font-weight: 700;
    padding: 14px 32px;
    border-radius: 14px;
    border: none;
    transition: 0.3s;
  }

  .btn-modern:hover {
    background: #e0d7ff;
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  }


    /* Tarjetas Glassmorphism */
    .card-glass {
      background: rgba(255, 255, 255, 0.55);
      backdrop-filter: blur(14px);
      border-radius: 32px;
      border: 1px solid rgba(45, 85, 125, 0.2);
      transition: all 0.3s ease;
      height: 100%;
      box-shadow: 0 12px 28px -8px rgba(13, 13, 13, 0.047);
    }
    .card-glass:hover {
      background: rgba(255, 255, 255, 0.7);
      border-color: rgba(45, 85, 125, 0.4);
      transform: translateY(-5px);
    }
    .info-chip {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(4px);
      border-radius: 2rem;
      padding: 0.5rem 1.2rem;
      font-size: 0.85rem;
      font-weight: 500;
      color: #1e3a5f;
      border: 0.5px solid rgba(45,85,125,0.2);
    }
    .stat-number {
      font-size: 2rem;
      font-weight: 800;
      font-family: 'Playfair Display', serif;
      background: linear-gradient(135deg, #1e3a5f, #3f7baf);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
    }
    .gold-divider {
      width: 70px;
      height: 3px;
      background: linear-gradient(90deg, #2d557d, #7fa1c3);
      margin: 1rem 0 1.5rem 0;
      border-radius: 4px;
    }
    .media-frame-glass {
      background: rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(8px);
      border-radius: 28px;
      overflow: hidden;
      border: 1px solid rgba(45,85,125,0.2);
    }
    footer {
      background: rgba(30, 58, 95, 0.75);
      backdrop-filter: blur(12px);
      border-top: 1px solid rgba(255,255,240,0.2);
      color: #eef2fa;
    }
    .text-gold {
      color: #2d557d !important;
      font-weight: 600;
    }
    hr {
      background-color: #7fa1c3;
      opacity: 0.3;
    }
    @media (max-width: 768px) {
      .business-name {
        font-size: 2.3rem;
      }
      .glass-card-hero {
        padding: 1.5rem;
      }
    }
  </style>


<!-- Preloader -->
<div id="ms-preload" class="ms-preload">
  <div class="spinner-ring"></div>
</div>

<div class="ms-site-container">

  <!-- Hero con Glassmorphism y degradado -->
  <header class="hero-modern">
  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
        <div class="hero-badge mb-3">
          <i class="fas fa-bolt me-1"></i> Amazing Deals
        </div>
        <h1 class="business-name">
          {{strtoupper($empresa->nombre ?? 'FACEBOL STUDIO')}}
        </h1>
        <p class="lead mb-5" style="color: #cdc1ff; font-weight: 400; font-size: 1.25rem;">
          {{$empresa->promocion ?? 'Descubre la excelencia en tecnología y diseño con nuestras ofertas exclusivas.'}}
        </p>
        
        <div class="d-flex flex-wrap gap-3">
          <a href="#productos" class="btn btn-modern shadow-lg">
            Ver Productos
          </a>
          @if(isset($empresa->facebook))
            <a href="{{$empresa->facebook}}" class="btn btn-link text-white text-decoration-none fw-bold">
              <i class="fab fa-facebook-f me-2"></i> Seguir en redes
            </a>
          @endif
        </div>
      </div>

      <div class="col-lg-6 text-center" data-aos="zoom-in" data-aos-delay="200">
        <div class="product-showcase">
          <img src="{{asset('imagen/empresasproductos/'.$empresa->imagen1 ?? 'default-product.png')}}" 
               class="img-fluid" alt="Producto principal">
        </div>
      </div>

    </div>
  </div>

  <div class="floating-logo-corner d-none d-md-flex" data-aos="fade-up" data-aos-offset="0">
    <img src="{{asset('imagen/empresas/'.$empresa->imagen ?? 'logo.jpg')}}" alt="Brand Logo">
    <div>
      <p class="m-0 fw-bold small text-white">{{$empresa->nombre}}</p>
      <p class="m-0 x-small text-white-50" style="font-size: 0.7rem;">Sello de Calidad</p>
    </div>
  </div>
</header>
  <!-- About + información ejecutiva con glass -->
  <div class="container my-5 pt-4" id="about">
    <div class="row g-5">
      <div class="col-lg-7" data-aos="fade-right">
        <div class="card-glass p-4 p-xl-5">
          <span class="text-gold small fw-semibold"><i class="fas fa-feather-alt"></i> Filosofía corporativa</span>
          <h2 class="serif-heading fw-bold mt-2" style="font-family: 'Playfair Display';">Detalles que definen excelencia</h2>
          <div class="gold-divider"></div>
          <p class="lh-lg" style="color:#2c3f55;">{!! $empresa->descripcion ?? 'Un espacio donde la tradición y la innovación se fusionan para brindar experiencias inolvidables. Nuestro compromiso es ofrecer calidad superior y atención personalizada a cada cliente, creando relaciones de confianza en un entorno exclusivo.' !!}</p>
          <div class="row mt-4">
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-3 mb-3">
                <i class="fas fa-medal fa-2x" style="color: #2d557d;"></i>
                <div><strong class="fs-5">Garantía premium</strong><br><small class="text-secondary">Calidad asegurada</small></div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-3 mb-3">
                <i class="fas fa-clock fa-2x" style="color: #2d557d;"></i>
                <div><strong class="fs-5">Horario exclusivo</strong><br><small class="text-secondary">{{$empresa->horario ?? 'Lun a Vie 10am - 8pm'}}</small></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5" data-aos="fade-left">
        <div class="card-glass p-4 h-100 d-flex flex-column">
          <h4 class="serif-heading fw-semibold"><i class="fas fa-chart-line me-2" style="color:#2d557d;"></i> Data ejecutiva</h4>
          <div class="mt-3">
            <div class="detail-grid d-flex flex-wrap gap-2">
              <div class="info-chip"><i class="fas fa-tag"></i> {{$empresa->descuento ?? 'Beneficio especial'}}</div>
              <div class="info-chip"><i class="fas fa-phone-alt"></i> {{$empresa->telefono ?? '+591 76000000'}}</div>
              <div class="info-chip"><i class="fas fa-map-pin"></i> {{$empresa->ciudad->nombre ?? 'La Paz · Santa Cruz'}}</div>
            </div>
            <hr class="my-4">
            <div><i class="fas fa-eye me-2" style="color:#2d557d;"></i> <strong class="text-dark">Visitas totales:</strong> <span class="stat-number">{{$empresa->nvisitas ?? 3250}}</span> <span class="text-secondary">interacciones</span></div>
            <div class="mt-4 pt-2">
              <p><i class="fas fa-map-marker-alt me-2" style="color:#2d557d;"></i> <strong>Dirección selecta</strong><br> {{$empresa->direccion ?? 'Avenida central, Galería empresarial'}}</p>
              @if(isset($empresa->facebook))
              <a href="{{$empresa->facebook}}" class="btn btn-outline-glass w-100 mt-2" target="_blank"><i class="fab fa-facebook-f me-2"></i>Conectar vía Facebook</a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Sección multimedia con Glassmorphism -->
  <div class="container my-5" id="media">
    <div class="text-center mb-5" data-aos="fade-up">
      <span class="text-uppercase small fw-semibold" style="color:#2d557d;">Contenido inmersivo</span>
      <h2 class="serif-heading fw-bold display-6" style="font-family: 'Playfair Display';">Experiencia audiovisual</h2>
      <div class="gold-divider mx-auto"></div>
    </div>
    <div class="row g-4">
      <div class="col-md-6" data-aos="zoom-in">
        <div class="media-frame-glass p-3 h-100">
          <h4 class="fs-5 fw-semibold mb-3"><i class="fab fa-youtube me-2 text-danger"></i> Presentación corporativa</h4>
          @if(isset($empresa->video) && $empresa->video != NULL)
            <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
              <iframe src="https://www.youtube.com/embed/{{$empresa->video}}" title="video promocional" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          @elseif(isset($empresa->videof) && $empresa->videof != NULL)
            <div class="bg-light rounded-4 p-5 text-center border" style="background: rgba(255,255,245,0.6);">
              <i class="fab fa-facebook-f fa-3x mb-3 text-primary"></i>
              <p>Video alojado en Facebook: <a href="{{$empresa->videof}}" target="_blank" class="fw-bold" style="color:#2d557d;">Ver ahora <i class="fas fa-arrow-right"></i></a></p>
            </div>
          @else
            <div class="bg-light rounded-4 p-5 text-center border" style="background: rgba(255,255,245,0.5);">
              <i class="fas fa-play-circle fa-3x mb-2 text-secondary"></i>
              <p class="mb-0">Material en producción, próximamente.</p>
            </div>
          @endif
        </div>
      </div>
      <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
        <div class="media-frame-glass p-3 h-100">
          <h4 class="fs-5 fw-semibold mb-3"><i class="fas fa-camera-retro me-2" style="color:#2d557d;"></i> Galería signature</h4>
          <div class="rounded-4 overflow-hidden shadow-sm">
            @if(isset($empresa->imagen1) && $empresa->imagen1)
              <a href="{{asset('imagen/empresasproductos/'.$empresa->imagen1)}}" target="_blank">
                <img src="{{asset('imagen/empresasproductos/'.$empresa->imagen1)}}" alt="Vista premium" class="img-fluid w-100" style="height: 280px; object-fit: cover; transition: 0.3s;">
              </a>
            @else
              <div class="d-flex align-items-center justify-content-center bg-white bg-opacity-50" style="height: 280px;">
                <div class="text-center"><i class="fas fa-image fa-3x text-secondary mb-2"></i><br>Imagen representativa</div>
              </div>
            @endif
          </div>
          <div class="mt-3 text-secondary small text-center">Ambientes diseñados con refinamiento</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Ubicación y mapa con glass -->
  <div class="container my-5" id="location">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10" data-aos="fade-up">
        <div class="card-glass overflow-hidden">
          <div class="row g-0">
            <div class="col-md-5 p-4 d-flex flex-column justify-content-center" style="background: rgba(255,255,250,0.5); backdrop-filter: blur(4px);">
              <i class="fas fa-location-dot fa-2x mb-3" style="color: #2d557d;"></i>
              <h3 class="serif-heading fw-bold">Punto de encuentro</h3>
              <p class="small text-secondary">Visítenos en nuestras instalaciones, un ambiente diseñado para recibirle con distinción.</p>
              <hr class="my-3">
              <p><i class="fas fa-clock me-2"></i> Horario: {{$empresa->horario ?? '09:00 - 20:00 hs'}}</p>
              <p><i class="fas fa-building me-2"></i> {{$empresa->direccion ?? 'Zona empresarial, anillo central'}}</p>
            </div>
            <div class="col-md-7 p-0">
              @if(isset($empresa->mapa) && $empresa->mapa != null)
                <iframe src="https://www.google.com/maps/embed?pb={{$empresa->mapa}}" width="100%" height="320" frameborder="0" style="border:0; display:block;" allowfullscreen="" loading="lazy"></iframe>
              @else
                <div class="d-flex align-items-center justify-content-center" style="height: 320px; background: rgba(245,245,245,0.5);">
                  <div class="text-center p-4"><i class="fas fa-map fa-3x text-secondary mb-2"></i><br>Mapa actualizándose próximamente</div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Contacto elegante glass -->
  <div class="container my-5" id="contact">
    <div class="row g-4">
      <div class="col-md-6" data-aos="fade-right">
        <div class="card-glass p-4 h-100">
          <div class="d-flex align-items-center gap-3 mb-3">
            <i class="fas fa-envelope-open-text fa-2x" style="color: #2d557d;"></i>
            <h4 class="serif-heading fw-bold mb-0">Atención personalizada</h4>
          </div>
          <p>¿Desea agendar una cita o solicitar información adicional? Nuestro equipo ejecutivo responderá a la brevedad.</p>
          <div class="mt-auto">
            <div class="mt-3"><i class="fas fa-phone-alt me-3" style="color:#2d557d;"></i> {{$empresa->telefono ?? '+591 2 123456'}}</div>
            <div class="mt-2"><i class="fas fa-globe me-3" style="color:#2d557d;"></i> www.facebol.business / contacto</div>
          </div>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <div class="card-glass p-4 h-100 text-center">
          <i class="fas fa-handshake fa-3x mb-3" style="color:#2d557d;"></i>
          <h5 class="fw-bold">Valoramos su confianza</h5>
          <p class="small">Más de {{$empresa->nvisitas ?? 2500}} visitas nos respaldan como un referente de calidad.</p>
          <div class="d-flex justify-content-center gap-3 mt-2">
            <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 42px; height:42px; line-height: 40px;"><i class="fab fa-instagram"></i></a>
            <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 42px; height:42px;"><i class="fab fa-whatsapp"></i></a>
            @if(isset($empresa->facebook))<a href="{{$empresa->facebook}}" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="fab fa-facebook-f"></i></a>@endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer glassmorphism -->
  <footer class="pt-5 pb-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center text-md-start">
          <a class="navbar-brand fs-4 fw-semibold" href="#" style="color:#f0f4fa;">Facebol<span class="text-light">·Corporate</span></a>
          <p class="small mt-2 mb-0">© 2025 — Excelencia y distinción en cada detalle.</p>
        </div>
        <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
          <i class="fas fa-certificate me-2"></i> Marca premium | Negocios con prestigio
        </div>
      </div>
    </div>
  </footer>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 700, once: true, offset: 20 });
  window.addEventListener('load', function() {
    const preloader = document.getElementById('ms-preload');
    if(preloader) {
      preloader.style.opacity = '0';
      setTimeout(() => { preloader.style.display = 'none'; }, 500);
    }
  });
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      if(targetId !== "#" && targetId !== "" && targetId !== "#!" && targetId !== "#0") {
        const targetEl = document.querySelector(targetId);
        if(targetEl) {
          e.preventDefault();
          targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
    });
  });
</script>
@include('sweetalert::alert')
@endsection
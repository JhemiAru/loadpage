
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
                                @if($institucion->banner1)
                                    <img src="{{ asset('imagen/institucion/' . $institucion->banner1) }}" 
                                         alt="Banner 1" 
                                         class="carousel-img">
                                @else
                                    <img src="{{ asset('imagen/institucion/mock-imac-material2.png') }}" 
                                         alt="Default" 
                                         class="carousel-img">
                                @endif
                            </div>
                            <div class="col-lg-8 descripcion text-end">
                                <h2 class="hero-title">Tarjeta de <span class="highlight">descuentos</span><br>y <span class="highlight">promociones</span></h2>
                                <p class="hero-sub">{{$institucion->frase1}}</p>
                                <div class="d-flex gap-3 flex-wrap mt-3">
                                    <a href="https://api.whatsapp.com/send?phone=591{{ $institucion2->celular }}&text=Hola!%20Quiero%20más%20información%20sobre%20la%20tarjeta%20FaceBol."                      
                                        class="btn btn-1" target="_blank">Detalles</a>
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
                                @if($institucion->banner2)
                                    <img src="{{ asset('imagen/institucion/' . $institucion->banner2) }}" 
                                         alt="Banner 2" 
                                         class="carousel-img">
                                @else
                                    <img src="{{ asset('imagen/institucion/mock-imac-material2.png') }}" 
                                         alt="Default" 
                                         class="carousel-img">
                                @endif
                            </div>
                            <div class="col-lg-8 descripcion text-end">                            
                                <h2 class="hero-title">Impulsa tu <span class="highlight">negocio</span><br>con <span class="highlight">nosotros</span></h2>
                                <p class="hero-sub">{{$institucion->frase2}}</p>
                                <div class="d-flex gap-3 flex-wrap mt-3">
                                    <a href="https://api.whatsapp.com/send?phone=591{{ $institucion2->celular }}&text=Hola!%20Quiero%20más%20información%20de%20FaceBol."                      
                                        class="btn btn-2" target="_blank">Contactarse</a>
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
                                @if($institucion->banner3)
                                    <img src="{{ asset('imagen/talleres/' . $institucion->banner3) }}" 
                                         alt="Banner 3" 
                                         class="carousel-img">
                                @else
                                    <img src="{{ asset('imagen/institucion/mock-imac-material2.png') }}" 
                                         alt="Default" 
                                         class="carousel-img">
                                @endif
                            </div>
                            <div class="col-lg-8 descripcion text-end">
                                <h2 class="hero-title">Taller con <span class="highlight">certificado</span><br> y valor <span class="highlight">curricular</span></h2>
                                <p class="hero-sub">{{$institucion->frase3}}</p>
                                <div class="d-flex gap-3 flex-wrap mt-3">                                    
                                    <a href="{{ route('taller') }}" class="btn btn-1">Más información</a>
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
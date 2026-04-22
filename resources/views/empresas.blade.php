@extends('template')
@section('content')
    <style>
    /* Hero Moderno con degradado lila/azul */
    .ms-hero-glass {
        background: radial-gradient(circle at 70% 30%, #5d44cc 0%, #2d1b6b 100%);
        padding: 100px 0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .glass-search-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        padding: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    /* Tarjetas estilo Sucursales (Imagen 2) */
    .branch-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        background: #fff;
        height: 100%;
        position: relative;
    }

    .branch-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    }

    .branch-img-container {
        position: relative;
        height: 400px;
    }

    .branch-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Overlay de información flotante sobre la imagen */
    .branch-info-overlay {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        padding: 20px;
        border-radius: 18px;
        color: white;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .badge-status {
        font-size: 0.7rem;
        padding: 5px 12px;
        border-radius: 50px;
        background: rgba(255,255,255,0.9);
        color: #333;
        font-weight: 700;
        text-transform: uppercase;
    }

    .search-input-modern {
        background: rgba(255, 255, 255, 0.9) !important;
        border-radius: 50px !important;
        padding: 15px 25px !important;
        border: none !important;
    }
</style>  
  <body>
   
    <div id="ms-preload" class="ms-preload">
      <div id="status">
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
    </div>
    <div class="ms-site-container">


    <section class="ms-hero-glass">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center mb-5">
                    <h1 class="business-name animated zoomIn" style="font-size: 3.5rem; font-weight: 800; color: white;">
                        {{$institucion->tituloempresa}}
                    </h1>
                    <p class="lead color-light animated fadeInUp" style="opacity: 0.8;">
                        {{$institucion->desEmpresa}}
                    </p>
                </div>
                
                <div class="col-md-8 offset-md-2">
                    <div class="glass-search-card animated fadeInUp">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <h2 class="text-center mb-5 fw-800" style="font-size: 2.5rem; color: #333;">Nuestras Empresas</h2>
        <div class="row g-4">
            @foreach($empresas as $empresa)
                @if($empresa->activo == 1)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="branch-card">
                        <div class="branch-img-container">
                            <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}" alt="{{$empresa->nombre}}">
                            
                            <div class="branch-info-overlay">
                                <h4 class="mb-1 fw-700">{{$empresa->nombre}}</h4>
                                <p class="small mb-2" style="opacity: 0.9;">
                                    <i class="zmdi zmdi-pin"></i> {{$empresa->direccion ?? 'Ubicación disponible'}}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge-status">Abierto</span>
                                    <a href="{{route('detalleEmpresa',$empresa->slug)}}" class="btn btn-white btn-sm fw-bold shadow-sm" style="border-radius: 10px; font-size: 0.75rem;">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-3 d-flex justify-content-around border-top bg-light">
                            <small class="text-muted"><i class="zmdi zmdi-star text-warning"></i> {{$empresa->descuento}}</small>
                            <small class="text-muted"><i class="zmdi zmdi-eye"></i> {{$empresa->nvisitas}}</small>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

</div>

    <script src="{{asset('js/typeahead.bundle.js')}}"></script>

<!--      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 -->    
    <script type="text/javascript">
    $(function(){
        var empresas = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            // `states` is an array of state names defined in "The Basics"
           prefetch:'{{ url("empresas/json")}}'
          });

      //inicializa typeahead sobre nueestro input de busqueda
      $('#search').typeahead({
        hint:true,
        highlight:true,
        minLenhth:1
      }, {
        name:'empresas',
        source:empresas

      });

    });
  </script>
@endsection
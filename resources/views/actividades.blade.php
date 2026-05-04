@extends('template')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/categoria.css') }}">
@endpush

@section('content')
    <style>
        /* Encabezado moderno */
        .hero-header {
            text-align: center;
            margin-bottom: 3.5rem;
            position: relative;
        }

        .hero-header h1 {
            font-size: 3.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e2a3e, #c0392b);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.02em;
            margin-bottom: 0.75rem;
            display: inline-block;
        }

        .hero-sub {
            font-size: 1.2rem;
            color: #5a6874;
            max-width: 650px;
            margin: 0 auto;
            font-weight: 400;
            border-bottom: 2px solid rgba(192, 57, 43, 0.2);
            display: inline-block;
            padding-bottom: 0.5rem;
        }

        .decoration-line {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #c0392b, #e67e22);
            margin: 1rem auto 0;
            border-radius: 4px;
        }

        /* Tarjetas modernas */
        .card-actividad-modern {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(2px);
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(0, 0, 0, 0.02);
            transition: transform 0.25s ease, box-shadow 0.3s ease;
            margin-bottom: 2rem;
        }

        .card-actividad-modern:hover {
            transform: translateY(-6px);
            box-shadow: 0 28px 40px -16px rgba(0, 0, 0, 0.2);
        }

        /* Zona fecha */
        .fecha-modern {
            background: linear-gradient(145deg, #2c3e50, #1a2632);
            padding: 1.5rem 1rem;
            text-align: center;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .fecha-modern .dia-numero {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.02em;
            background: linear-gradient(120deg, #fff, #ffe0b5);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            text-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .fecha-modern .mes-texto {
            font-size: 1.1rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 0.25rem;
            opacity: 0.9;
        }

        .fecha-modern .anio-texto {
            font-size: 1rem;
            font-weight: 400;
            background: rgba(255,255,240,0.2);
            display: inline-block;
            padding: 0.2rem 1rem;
            border-radius: 40px;
            margin-top: 0.5rem;
            backdrop-filter: blur(4px);
        }

        .estado-badge-modern {
            margin-top: 1rem;
            background: rgba(255,255,245,0.2);
            backdrop-filter: blur(8px);
            border-radius: 60px;
            padding: 0.3rem 1.2rem;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #ffefcf;
            border: 1px solid rgba(255,215,150,0.6);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Contenido */
        .contenido-modern {
            padding: 1.8rem 2rem;
        }

        .actividad-titulo {
            font-size: 1.7rem;
            font-weight: 700;
            color: #1f2e3a;
            letter-spacing: -0.3px;
            margin-bottom: 0.75rem;
            transition: color 0.2s;
        }

        .actividad-titulo:hover {
            color: #c0392b;
        }

        /* Contenedor de descripción con altura variable */
        .descripcion-container {
            position: relative;
            margin-bottom: 1.2rem;
        }

        .descripcion-corta {
            color: #4a5b6b;
            line-height: 1.6;
            font-size: 0.95rem;
            border-left: 3px solid #e67e22;
            padding-left: 1rem;
            transition: all 0.3s ease;
        }

        /* Estado colapsado - solo para cuando el texto es largo y el botón existe */
        .descripcion-corta.collapsible {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Botón leer más */
        .btn-leer {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #c0392b;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            padding: 0;
            transition: all 0.2s;
            margin-bottom: 1.2rem;
        }

        .btn-leer i {
            transition: transform 0.2s;
        }

        .btn-leer:hover {
            color: #a82314;
            gap: 12px;
        }

        .btn-leer:hover i {
            transform: translateX(4px);
        }

        /* Imagen */
        .img-wrapper {
            border-radius: 1.2rem;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            background: #f8f9fa;
        }

        .actividad-img-modern {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
            display: block;
        }

        .img-wrapper:hover .actividad-img-modern {
            transform: scale(1.03);
        }

        /* Modal personalizado */
        .modal-modern .modal-content {
            border-radius: 1.5rem;
            border: none;
            box-shadow: 0 30px 50px rgba(0,0,0,0.2);
        }

        .modal-modern .modal-header {
            background: linear-gradient(135deg, #2c3e50, #1a2632);
            color: white;
            border-radius: 1.5rem 1.5rem 0 0;
            border-bottom: none;
            padding: 1.5rem 2rem;
        }

        .modal-modern .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .modal-fecha-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.2);
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .modal-imagen {
            border-radius: 1rem;
            overflow: hidden;
            margin: 1rem 0;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .modal-imagen img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }

        .descripcion-completa {
            line-height: 1.7;
            color: #2c3e50;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .custom-container {
                padding: 0 1rem;
            }
            .hero-header h1 {
                font-size: 2.2rem;
            }
            .contenido-modern {
                padding: 1.5rem;
            }
            .fecha-modern {
                padding: 1rem;
                flex-direction: row;
                justify-content: space-evenly;
                align-items: center;
                gap: 0.5rem;
                flex-wrap: wrap;
            }
            .fecha-modern .dia-numero {
                font-size: 2rem;
            }
            .estado-badge-modern {
                margin-top: 0;
            }
            .actividad-titulo {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 576px) {
            .fecha-modern {
                flex-direction: column;
                gap: 0.3rem;
            }
        }

        .card-actividad-modern {
            animation: fadeUp 0.5s ease-out backwards;
        }
        
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fecha-modern::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 20%, rgba(255,215,150,0.1) 0%, rgba(0,0,0,0) 70%);
            pointer-events: none;
        }
    </style>
</head>
<body>

<div class="custom-container">
    
    <div class="hero-header">
        <h1>
            <i class="fas fa-calendar-alt me-2" style="background: linear-gradient(135deg, #c0392b, #e67e22); background-clip: text; -webkit-background-clip: text; color: transparent;"></i>
            {{$institucion->tituloactividades ?? 'Próximas Actividades'}}
        </h1>
        <div class="decoration-line"></div>
        <p class="hero-sub mt-3">
            <i class="fas fa-star-of-life me-1" style="font-size: 0.7rem; color:#c0392b;"></i> 
            {{$institucion->desactividades ?? 'Vive experiencias únicas, mantente al día con nuestros eventos'}}
        </p>
    </div>

    <div class="row g-4">
        @foreach($actividades as $index => $actividad)
        @if($actividad->tipo == 'actividad' && $actividad->activo == 1)
        @php
            // Limpiar y obtener la descripción completa sin etiquetas HTML
            $descripcionLimpia = strip_tags($actividad->descripcion);
            $longitudDescripcion = strlen($descripcionLimpia);
            // Umbral de caracteres para mostrar el botón (más de 150 caracteres o más de 3 lineas aproximadas)
            $mostrarBotonLeer = $longitudDescripcion > 150;
            // Descripción corta (primeros 180 caracteres aprox)
            $descripcionCorta = \Illuminate\Support\Str::limit($descripcionLimpia, 150);
        @endphp
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
                            <div class="estado-badge-modern">
                                <i class="fas fa-check-circle"></i> Finalizado
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-lg-10">
                        <div class="contenido-modern">
                            <div class="d-flex flex-wrap justify-content-between align-items-start">
                                <h3 class="actividad-titulo">
                                    <i class="fas fa-flag-checkered me-2" style="color: #e67e22; font-size: 1.3rem;"></i>
                                    {{$actividad->nombre}}
                                </h3>
                                <span class="badge bg-light text-dark px-3 py-1 rounded-pill shadow-sm mb-2">
                                    <i class="far fa-clock"></i> Evento especial
                                </span>
                            </div>

                            <!-- Descripción inteligente: solo muestra descripción corta inicial -->
                            <div class="descripcion-container">
                                <div class="descripcion-corta @if($mostrarBotonLeer) collapsible @endif" id="desc-{{ $actividad->id }}">
                                    {{ $descripcionCorta }}
                                </div>
                            </div>

                            <!-- Botón Leer más: SOLO aparece si la descripción es larga -->
                            @if($mostrarBotonLeer)
                            <button class="btn-leer" data-id="{{ $actividad->id }}" data-bs-toggle="modal" data-bs-target="#modalActividad-{{ $actividad->id }}">
                                Leer más <i class="fas fa-arrow-right"></i>
                            </button>
                            @endif

                            <div class="img-wrapper">
                                <img src="{{asset('imagen/actividades/'.$actividad->imagen)}}" 
                                     alt="Imagen de {{$actividad->nombre}}"
                                     class="actividad-img-modern"
                                     onerror="this.onerror=null; this.src='https://placehold.co/800x500/f0f0f0/ccc?text=Imagen+no+disponible';">
                            </div>

                            <div class="mt-3 d-flex gap-3 small text-muted">
                                <span><i class="fas fa-tag"></i> Cultural</span>
                                <span><i class="fas fa-users"></i> Comunidad</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL para descripción completa (solo se genera si el botón existe) -->
        @if($mostrarBotonLeer)
        <div class="modal fade modal-modern" id="modalActividad-{{ $actividad->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $actividad->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h4 class="modal-title fw-bold" id="modalLabel-{{ $actividad->id }}">
                                <i class="fas fa-calendar-alt me-2"></i>{{ $actividad->nombre }}
                            </h4>
                            <div class="modal-fecha-badge mt-2">
                                <i class="fas fa-calendar-day"></i>
                                <span>{{ $actividad->dia }} de {{ $actividad->mes }}, {{ $actividad->año }}</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Imagen destacada en el modal -->
                        <div class="modal-imagen">
                            <img src="{{asset('imagen/actividades/'.$actividad->imagen)}}" 
                                 alt="{{$actividad->nombre}}"
                                 onerror="this.onerror=null; this.src='https://placehold.co/800x500/f0f0f0/ccc?text=Imagen+no+disponible';">
                        </div>
                        
                        <!-- Descripción completa -->
                        <div class="descripcion-completa mt-3">
                            {!! nl2br(e($descripcionLimpia)) !!}
                        </div>
                        
                        <!-- Información adicional -->
                        <hr class="my-4">
                        <div class="row text-muted small">
                            <div class="col-md-6">
                                <i class="fas fa-map-marker-alt me-2"></i> Evento presencial
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-clock me-2"></i> Horario: Consultar disponibilidad
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Cerrar
                        </button>
                        <button type="button" class="btn btn-primary rounded-pill px-4" style="background: linear-gradient(135deg, #c0392b, #e67e22); border: none;">
                            <i class="fas fa-share-alt"></i> Compartir
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif
        @endforeach
    </div>

    @php
        $hasActive = false;
        foreach($actividades as $act) {
            if($act->tipo == 'actividad' && $act->activo == 1) { $hasActive = true; break; }
        }
    @endphp
    @if(!$hasActive)
    <div class="text-center py-5 my-5">
        <div class="bg-white p-5 rounded-4 shadow-sm d-inline-block">
            <i class="fas fa-calendar-times fa-3x text-secondary mb-3"></i>
            <h4 class="fw-semibold">No hay actividades disponibles</h4>
            <p class="text-muted">Pronto publicaremos nuevas experiencias para ti.</p>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Manejo de imágenes rotas para todas las imágenes (incluyendo modales)
    document.querySelectorAll('.actividad-img-modern, .modal-imagen img').forEach(img => {
        img.addEventListener('error', function(e) {
            if(!this.dataset.fallback) {
                this.dataset.fallback = 'true';
                this.src = 'https://placehold.co/800x500/eeeeee/aaaaaa?text=Imagen+no+disponible';
            }
        });
    });

    // Función para verificar si el texto es lo suficientemente largo como para necesitar el botón
    // (Esto ya se maneja con PHP, pero lo mantenemos como respaldo)
    document.querySelectorAll('.descripcion-corta').forEach(desc => {
        // Si el texto tiene más de 150 caracteres y no tiene la clase 'collapsible' aplicada, la aplicamos
        const texto = desc.innerText.trim();
        if(texto.length > 150 && !desc.classList.contains('collapsible')) {
            desc.classList.add('collapsible');
            // Buscar el botón correspondiente y mostrarlo si estaba oculto
            const card = desc.closest('.card-actividad-modern');
            if(card) {
                let btn = card.querySelector('.btn-leer');
                if(btn && btn.style.display !== 'inline-flex') {
                    btn.style.display = 'inline-flex';
                }
            }
        }
    });

    // Asegurar que los modales se limpien correctamente y funcionen con botones dinámicos
    var myModals = document.querySelectorAll('.modal');
    myModals.forEach(function(modalEl) {
        var modal = new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: true
        });
        // Almacenar instancia para evitar conflictos
        modalEl.addEventListener('click', function(e) {
            if(e.target === modalEl) {
                modal.hide();
            }
        });
    });

    // Prevenir que el botón dentro de la tarjeta tenga conflictos
    document.querySelectorAll('.btn-leer').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // El modal se abre automáticamente por data-bs-target, pero aseguramos
            const targetId = this.getAttribute('data-bs-target');
            if(targetId) {
                const modalElement = document.querySelector(targetId);
                if(modalElement) {
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if(modalInstance) {
                        modalInstance.show();
                    } else {
                        new bootstrap.Modal(modalElement).show();
                    }
                }
            }
            e.preventDefault();
        });
    });

    // Pequeña mejora: si hay descripciones que exceden pero no se generó modal por error,
    // mostramos consola amigable
    console.log('✅ Sistema de "Leer más" activado - Solo aparece cuando hay más de 150 caracteres');
</script>

<!-- Estilos adicionales para modales -->
<style>
    .modal-modern .modal-content {
        overflow: hidden;
    }
    .modal-modern .btn-primary:hover {
        background: linear-gradient(135deg, #a82314, #d35400) !important;
        transform: translateY(-2px);
        transition: all 0.2s;
    }
    .modal-modern .btn-outline-secondary:hover {
        background: #f8f9fa;
        border-color: #c0392b;
        color: #c0392b;
    }
    .descripcion-completa {
        white-space: pre-wrap;
        word-wrap: break-word;
    }
    /* Animación suave para modal */
    .modal.fade .modal-dialog {
        transform: scale(0.95);
        transition: transform 0.2s ease-out;
    }
    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>
@endsection
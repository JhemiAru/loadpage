@extends('inicio.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
@endpush

@section('content')

<section class="contacto-hero">
    <div class="contacto-hero-inner">
        <div class="container">
            <h1><i class="fas fa-paper-plane me-2" style="color:var(--accent)"></i>Contáctanos</h1>
            <p>¿Tienes alguna consulta o quieres unirte a nuestra red? Escríbenos y te respondemos a la brevedad.</p>
        </div>
    </div>
    <svg class="contacto-hero-wave" viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0,20 C480,70 960,-10 1440,20 L1440,60 L0,60 Z" fill="#f4f7fc"/>
    </svg>
</section>

<section class="contacto-section">
    <div class="container">
        <div class="row g-4 align-items-start">

            <div class="col-lg-4 d-flex flex-column gap-4">

                <div class="info-card">
                    <div class="info-card-title">
                        <i class="fas fa-address-card"></i>
                        Información de contacto
                    </div>

                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <a href="https://maps.app.goo.gl/npVGBP5QBrFWfk6MA" target="_blank">
                            {{ $institucion->direccion ?? 'El Alto, Zona Ballivian, Av. Chacaltaya #50' }}
                        </a>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ $institucion->email }}">
                            {{ $institucion->email ?? 'facebolsrl@gmail.com' }}
                        </a>
                    </div>

                    @if($institucion->celular)
                    <div class="info-item">
                        <i class="fab fa-whatsapp"></i>
                        <a href="https://api.whatsapp.com/send?phone=591{{ $institucion->celular }}&text=Hola!%20Quiero%20más%20información%20de%20FaceBol."
                           target="_blank">
                            {{ $institucion->celular }}
                        </a>
                    </div>
                    @endif

                    @if($institucion->telefono)
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $institucion->telefono }}</span>
                    </div>
                    @endif

                    <div class="info-card-title mt-3" style="font-size:0.9rem">
                        <i class="fas fa-share-alt"></i>
                        Redes sociales
                    </div>
                    <div class="redes-wrap">
                        @if($institucion->facebook)
                            <a href="{{ $institucion->facebook }}" class="btn-red btn-red-fb" target="_blank" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($institucion->celular)
                            <a href="https://api.whatsapp.com/send?phone=591{{ $institucion->celular }}" class="btn-red btn-red-wa" target="_blank" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif
                        @if($institucion->instagram)
                            <a href="{{ $institucion->instagram }}" class="btn-red btn-red-ig" target="_blank" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($institucion->youtube)
                            <a href="{{ $institucion->youtube }}" class="btn-red btn-red-yt" target="_blank" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        @endif
                        @if($institucion->tiktok)
                            <a href="{{ $institucion->tiktok }}" class="btn-red btn-red-tk" target="_blank" title="TikTok">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        @endif
                    </div>
                </div>

                @if($institucion->celular)
                <a href="https://api.whatsapp.com/send?phone=591{{ $institucion->celular }}&text=Hola!%20Quiero%20más%20información%20de%20FaceBol."
                   class="btn-whatsapp-cta"
                   target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <div>
                        Escríbenos por WhatsApp
                        <small>Respuesta rápida garantizada</small>
                    </div>
                </a>
                @endif

                <div class="mapa-wrap">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1912.8883755920097!2d-68.171327!3d-16.4868382!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915edfc30c82a547%3A0xb1da29fadc068880!2sFACE%20BOL%20SRL!5e0!3m2!1ses-419!2sbo!4v1776908049952!5m2!1ses-419!2sbo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>

            <div class="col-lg-8">
                <div class="form-card">
                    <h2>Envíanos un mensaje</h2>
                    <p class="form-sub">Completa el formulario y nos pondremos en contacto contigo lo antes posible.</p>

                    @if(session('success'))
                        <div class="form-alert success" style="display:flex; align-items:center; gap:8px">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="form-alert error" style="display:flex; align-items:center; gap:8px">
                            <i class="fas fa-exclamation-circle"></i> Por favor completa todos los campos correctamente.
                        </div>
                    @endif

                    <form action="{{ route('email_post') }}" method="POST">
                    @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="campo-grupo">
                                    <label class="campo-label" for="nombre">Nombre completo</label>
                                    <input type="text"
                                           id="nombre"
                                           name="nombre"
                                           class="campo-input"
                                           placeholder="Tu nombre"
                                           value="{{ old('nombre') }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="campo-grupo">
                                    <label class="campo-label" for="email">Correo electrónico</label>
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           class="campo-input"
                                           placeholder="tucorreo@ejemplo.com"
                                           value="{{ old('email') }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="campo-grupo">
                                    <label class="campo-label" for="celular">Celular / WhatsApp</label>
                                    <input type="tel"
                                           id="celular"
                                           name="celular"
                                           class="campo-input"
                                           placeholder="Ej: 76000000"
                                           value="{{ old('celular') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="campo-grupo">
                                    <label class="campo-label" for="situacion">Asunto</label>
                                    <input type="text"
                                           id="situacion"
                                           name="situacion"
                                           class="campo-input"
                                           placeholder="¿En qué podemos ayudarte?"
                                           value="{{ old('situacion') }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="campo-grupo">
                                    <label class="campo-label" for="mensaje">Mensaje</label>
                                    <textarea id="mensaje"
                                              name="mensaje"
                                              class="campo-input textarea"
                                              placeholder="Escribe tu mensaje aquí..."
                                              required>{{ old('mensaje') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 flex-wrap mt-2">
                            <button type="submit" class="btn-enviar">
                                <i class="fas fa-paper-plane"></i> Enviar mensaje
                            </button>
                            <span style="font-size:0.8rem; color:var(--text-muted)">
                                <i class="fas fa-lock me-1"></i> Tu información es confidencial
                            </span>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
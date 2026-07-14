@extends('inicio.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/equipo.css') }}">
@endpush

@section('content')
{{-- ── CABECERA ── --}}
<section class="equipo-hero">
    <div class="equipo-hero-inner">
        <div class="container">
            <h1>
                <i class="fas fa-users me-2" style="color:var(--accent)"></i>
                {{ $institucion->tituloequipo ?? 'Nuestro Equipo' }}
            </h1>
            @if($institucion->desequipo)
                <p>{{ $institucion->desequipo }}</p>
            @endif
        </div>
    </div>
    <svg class="equipo-hero-wave" viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0,20 C480,70 960,-10 1440,20 L1440,60 L0,60 Z" fill="#f4f7fc"/>
    </svg>
</section>

{{-- ── GRID DE TARJETAS ── --}}
<section class="equipo-section">
    <div class="container">
        <div class="team-grid" id="teamGrid">

            @if(isset($equipos1) && count($equipos1) > 0)
                @foreach($equipos1 as $index => $equipo)
                    <div class="team-card-col"
                         style="animation-delay: {{ 0.08 + ($index * 0.07) }}s">

                        <div class="flip-container">
                            <div class="flip-inner">

                                {{-- FRENTE --}}
                                <div class="flip-front">
                                    <img src="{{ asset('imagen/equipos/' . $equipo->imagen) }}"
                                         alt="{{ $equipo->nombre }}"
                                         class="avatar-flip"
                                         onerror="this.src='https://ui-avatars.com/api/?background=1a3a6b&color=f5a623&bold=true&name={{ urlencode($equipo->nombre) }}'">

                                    <h3>{{ $equipo->nombre }}</h3>
                                    <span class="role-badge">{{ $equipo->cargo }}</span>

                                    @if($equipo->descripcion)
                                        <p class="desc-preview">
                                            {{ \Illuminate\Support\Str::limit($equipo->descripcion, 90) }}
                                        </p>
                                    @endif

                                    <div class="flip-hint">
                                        <i class="fas fa-sync-alt"></i>
                                        Toca para ver más
                                    </div>
                                </div>

                                {{-- REVERSO --}}
                                <div class="flip-back">
                                    <img src="{{ asset('imagen/equipos/' . $equipo->imagen) }}"
                                         alt="{{ $equipo->nombre }}"
                                         class="flip-back-avatar"
                                         onerror="this.src='https://ui-avatars.com/api/?background=1a3a6b&color=f5a623&bold=true&name={{ urlencode($equipo->nombre) }}'">

                                    <h4>{{ $equipo->nombre }}</h4>
                                    <span class="back-cargo">{{ $equipo->cargo }}</span>

                                    <p class="back-desc">
                                        {{ $equipo->descripcion ?: 'Profesional comprometido con la excelencia y los valores de FaceBol.' }}
                                    </p>

                                    <div class="social-links-flip">
                                        @if($equipo->facebook && $equipo->facebook !== 'sdf')
                                            <a href="{{ $equipo->facebook }}" target="_blank"
                                               class="social-icon-flip" title="Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        @endif
                                        @if($equipo->twitter)
                                            <a href="{{ $equipo->twitter }}" target="_blank"
                                               class="social-icon-flip" title="Twitter / X">
                                                <i class="fab fa-x-twitter"></i>
                                            </a>
                                        @endif
                                        @if($equipo->instagram)
                                            <a href="{{ $equipo->instagram }}" target="_blank"
                                               class="social-icon-flip" title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        @endif
                                        @if(empty($equipo->facebook && $equipo->facebook !== 'sdf') && empty($equipo->twitter) && empty($equipo->instagram))
                                            <span style="font-size:0.75rem; opacity:0.6">
                                                <i class="fas fa-user-circle me-1"></i> Equipo FaceBol
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                <div class="empty-equipo">
                    <i class="fas fa-users-slash"></i>
                    <h5>No hay miembros registrados aún.</h5>
                    <p>Pronto presentaremos a nuestro equipo.</p>
                </div>
            @endif

        </div>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('js/equipo.js') }}"></script>
@endpush
@endsection
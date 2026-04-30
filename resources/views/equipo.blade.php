@extends('template')

@push('styles')
<style>
/* ───────────────────────────────────────────────
   EQUIPO — estilo FaceBol con flip cards
─────────────────────────────────────────────── */

/* ── CABECERA ── */
.equipo-hero {
    padding: 50px 0 0;
    background: linear-gradient(135deg, #0d1f45 0%, #1a3a6b 55%, #1e4fa0 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.equipo-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
}

.equipo-hero-inner {
    position: relative;
    z-index: 1;
    padding-bottom: 55px;
}

.equipo-hero h1 {
    font-family: 'Poppins', sans-serif;
    font-weight: 800;
    font-size: 2.4rem;
    color: #fff;
    margin-bottom: 10px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.25);
}

.equipo-hero p {
    color: rgba(255,255,255,0.78);
    font-size: 1rem;
    max-width: 580px;
    margin: 0 auto;
    border-left: 4px solid var(--accent);
    padding-left: 1rem;
    text-align: left;
}

.equipo-hero-wave {
    display: block;
    width: 100%;
    margin-bottom: -2px;
}

/* ── SECCIÓN GRID ── */
.equipo-section {
    background: var(--section-bg);
    padding: 50px 0 70px;
}

/* Grid centrado con auto-fill */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 28px;
    max-width: 1200px;
    margin: 0 auto;
}

/* ── FLIP CARD ── */
.flip-container {
    perspective: 1600px;
    height: 420px;
}

.flip-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.7s cubic-bezier(0.23, 1, 0.32, 1);
    transform-style: preserve-3d;
    border-radius: 24px;
    box-shadow: 0 8px 28px rgba(26,58,107,0.13);
    cursor: pointer;
}

/* Hover en desktop */
@media (hover: hover) {
    .flip-container:hover .flip-inner {
        transform: rotateY(180deg);
    }
}

/* Girado por JS en touch */
.flip-inner.flipped {
    transform: rotateY(180deg);
}

/* Cara frontal y trasera */
.flip-front,
.flip-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    border-radius: 24px;
    overflow: hidden;
}

/* ── FRENTE ── */
.flip-front {
    background: var(--card-bg);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    padding: 1.6rem 1.4rem 1rem;
    border: 1px solid rgba(0,0,0,0.05);
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: rgba(46,107,196,0.2) transparent;
}

.avatar-flip {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid var(--accent);
    box-shadow: 0 10px 24px rgba(26,58,107,0.2);
    margin-bottom: 0.9rem;
    flex-shrink: 0;
    transition: transform 0.3s;
}

.flip-front:not(.overflow) {
    justify-content: center;
}

.flip-front:hover .avatar-flip {
    transform: scale(1.04);
}

.flip-front h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--primary);
    margin: 0 0 6px;
}

.role-badge {
    background: rgba(245,166,35,0.12);
    color: var(--accent2);
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 0.78rem;
    padding: 4px 16px;
    border-radius: 30px;
    display: inline-block;
    margin-bottom: 12px;
    border: 1px solid rgba(245,166,35,0.3);
}

.desc-preview {
    font-size: 0.84rem;
    color: var(--text-muted);
    line-height: 1.55;
    text-align: center;
    max-width: 92%;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.flip-hint {
    margin-top: 16px;
    font-size: 0.72rem;
    color: #aab4cc;
    letter-spacing: 0.4px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.flip-hint i {
    color: var(--blue-light);
    font-size: 0.75rem;
}

/* ── REVERSO ── */
.flip-back {
    background: linear-gradient(145deg, #0d1f45, #1a3a6b);
    transform: rotateY(180deg);
    display: flex;
    flex-direction: column;
    justify-content: flex-start;  /* ← era center */
    align-items: center;
    padding: 1.6rem 1.6rem 1rem;
    color: #fff;
    text-align: center;
    overflow-y: auto;             /* ← scroll interno */
    scrollbar-width: thin;
    scrollbar-color: rgba(245,166,35,0.3) transparent;
}

.flip-back-avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--accent);
    margin-bottom: 14px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.3);
}

.flip-back h4 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: #fff;
    border-bottom: 3px solid var(--accent);
    display: inline-block;
    padding-bottom: 6px;
    margin-bottom: 8px;
}

.flip-back .back-cargo {
    background: rgba(245,166,35,0.18);
    color: var(--accent);
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 0.78rem;
    padding: 4px 14px;
    border-radius: 30px;
    display: inline-block;
    margin-bottom: 14px;
}

.flip-back .back-desc {
    font-size: 0.86rem;
    line-height: 1.6;
    color: rgba(255,255,255,0.85);
    max-width: 240px;
    margin: 0 auto 14px;    
}

/* Íconos sociales del reverso */
.social-links-flip {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: auto;
    padding-top: 12px;
    flex-shrink: 0;
}

.social-icon-flip {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: #fff;
    text-decoration: none;
    transition: all 0.25s;
    border: 1px solid rgba(255,255,255,0.15);
}

.social-icon-flip:hover {
    background: var(--accent);
    color: var(--primary);
    transform: translateY(-3px);
    border-color: var(--accent);
}

/* ── ANIMACIÓN DE ENTRADA ── */
.team-card-col {
    opacity: 0;
    animation: fadeUp 0.6s ease forwards;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(22px); }
    to   { opacity: 1; transform: translateY(0);    }
}

/* ── ESTADO VACÍO ── */
.empty-equipo {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-muted);
    grid-column: 1 / -1;
}

.empty-equipo i {
    font-size: 3rem;
    color: #ccd3e0;
    margin-bottom: 14px;
    display: block;
}

.empty-equipo h5 {
    font-family: 'Poppins', sans-serif;
    color: var(--primary);
}

/* ── BOTÓN IR ARRIBA ── */
.go-top {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: var(--accent);
    color: var(--primary);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    box-shadow: 0 6px 16px rgba(0,0,0,0.2);
    cursor: pointer;
    z-index: 500;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s;
    border: none;
}

.go-top.show {
    opacity: 1;
    visibility: visible;
}

.go-top:hover {
    background: var(--accent2);
    color: #fff;
    transform: translateY(-3px);
}

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .equipo-hero h1 { font-size: 1.8rem; }

    .equipo-hero p {
        text-align: center;
        border-left: none;
        padding-left: 0;
        border-top: 3px solid var(--accent);
        padding-top: 10px;
    }

    .team-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .flip-container { height: 400px; }
}
</style>
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
                                        @if($equipo->facebook)
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
                                        @if(empty($equipo->facebook) && empty($equipo->twitter) && empty($equipo->instagram))
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
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Go Top ──
    const goTopBtn = document.getElementById('goTopBtn');
    window.addEventListener('scroll', () => {
        goTopBtn.classList.toggle('show', window.scrollY > 400);
    });
    goTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // ── Flip táctil en dispositivos touch ──
    if ('ontouchstart' in window) {
        document.querySelectorAll('.flip-inner').forEach(inner => {
            inner.addEventListener('click', function (e) {
                // No girar si el clic fue en un enlace social
                if (e.target.closest('a')) return;

                const isFlipped = this.classList.contains('flipped');

                // Cierra los demás
                document.querySelectorAll('.flip-inner.flipped').forEach(other => {
                    if (other !== this) other.classList.remove('flipped');
                });

                this.classList.toggle('flipped', !isFlipped);
            });
        });

        // Cierra al tocar fuera
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.flip-container')) {
                document.querySelectorAll('.flip-inner.flipped').forEach(inner => {
                    inner.classList.remove('flipped');
                });
            }
        });
    }

});
</script>
@endpush

@endsection
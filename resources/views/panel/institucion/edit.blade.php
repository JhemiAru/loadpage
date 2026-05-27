@extends('panel.layout')
@section('titulo', 'Configuración de la institución')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-building me-2"></i> Datos generales de FaceBol</h5>
    </div>

    <form method="POST" action="{{ route('actualizarInstitucion') }}" enctype="multipart/form-data" style="padding: 28px;">
        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- === INFORMACIÓN DE CONTACTO === --}}
        <div class="mb-4 pb-2 border-bottom">
            <h6 class="fw-bold" style="color: var(--primary);"><i class="fas fa-address-card me-2"></i> Información de contacto</h6>
        </div>
        <div class="row g-4">
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control-panel" value="{{ old('direccion', $institucion->direccion) }}" placeholder="Calle, número, zona...">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control-panel" value="{{ old('email', $institucion->email) }}" placeholder="contacto@facebol.com">                
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label-panel" for="celular">Celular</label>
                <input type="text" id="celular" name="celular" class="form-control-panel" value="{{ old('celular', $institucion->celular) }}" placeholder="76266570">
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label-panel" for="celular2">Celular de contacto para tarjeta</label>
                <input type="text" id="celular2" name="celular2" class="form-control-panel" value="{{ old('celular2', $institucion->celular2) }}" placeholder="77793217">
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label-panel" for="telefono">Teléfono fijo</label>
                <input type="text" id="telefono" name="telefono" class="form-control-panel" value="{{ old('telefono', $institucion->telefono) }}" placeholder="31231234">
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label-panel" for="visitas">Visitas (contador)</label>
                <input type="number" id="visitas" name="visitas" class="form-control-panel" value="{{ old('visitas', $institucion->visitas) }}" placeholder="0">
            </div>
        </div>

        {{-- === REDES SOCIALES === --}}
        <div class="mt-5 mb-4 pb-2 border-bottom">
            <h6 class="fw-bold" style="color: var(--primary);"><i class="fas fa-share-alt me-2"></i> Redes sociales</h6>
        </div>
        <div class="row g-4">
            <div class="col-md-3 form-group">
                <label class="form-label-panel" for="facebook">Facebook</label>
                <input type="url" id="facebook" name="facebook" class="form-control-panel" value="{{ old('facebook', $institucion->facebook) }}" placeholder="https://facebook.com/facebol">
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label-panel" for="tiktok">Tiktok</label>
                <input type="url" id="tiktok" name="tiktok" class="form-control-panel" value="{{ old('tiktok', $institucion->tiktok) }}" placeholder="https://tiktok.com/facebol">
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label-panel" for="youtube">YouTube</label>
                <input type="url" id="youtube" name="youtube" class="form-control-panel" value="{{ old('youtube', $institucion->youtube) }}" placeholder="https://youtube.com/c/facebol">
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label-panel" for="instagram">Instagram</label>
                <input type="url" id="instagram" name="instagram" class="form-control-panel" value="{{ old('instagram', $institucion->instagram) }}" placeholder="https://instagram.com/facebol">
            </div>
        </div>

        {{-- === CARRUSEL === --}}
        <div class="mt-5 mb-4 pb-2 border-bottom">
            <h6 class="fw-bold" style="color: var(--primary);"><i class="fas fa-pager me-2"></i> Carrusel Principal</h6>
        </div>
        <div class="row g-4">
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="banner1">Imagen 1 del carrusel</label>
                <input type="file" id="banner1" name="banner1" class="form-control-panel" accept="image/*" onchange="previewImagen(this, 'previewImgBanner1')">
                <div id="previewImgBanner1Wrapper" style="margin-top:10px; {{ $institucion->banner1 ? '' : 'display:none;' }}">
                    <img id="previewImgBanner1" src="{{ $institucion->banner1 ? asset('imagen/institucion/' . $institucion->banner1) : '' }}" class="img-preview-large">
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="banner2">Imagen 2 del carrusel</label>
                <input type="file" id="banner2" name="banner2" class="form-control-panel" accept="image/*" onchange="previewImagen(this, 'previewImgBanner2')">
                <div id="previewImgBanner2Wrapper" style="margin-top:10px; {{ $institucion->banner2 ? '' : 'display:none;' }}">
                    <img id="previewImgBanner2" src="{{ $institucion->banner2 ? asset('imagen/institucion/' . $institucion->banner2) : '' }}" class="img-preview-large">
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="banner3">Imagen 3 del carrusel</label>
                <input type="file" id="banner3" name="banner3" class="form-control-panel" accept="image/*" onchange="previewImagen(this, 'previewImgBanner3')">
                <div id="previewImgBanner3Wrapper" style="margin-top:10px; {{ $institucion->banner3 ? '' : 'display:none;' }}">
                    <img id="previewImgBanner3" src="{{ $institucion->banner3 ? asset('imagen/institucion/' . $institucion->banner3) : '' }}" class="img-preview-large">
                </div>
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="frase1">Descripción 1 del carrusel</label>
                <input type="text" id="frase1" name="frase1" class="form-control-panel" value="{{ old('frase1', $institucion->frase1) }}">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="frase2">Descripción 2 del carrusel</label>
                <input type="text" id="frase2" name="frase2" class="form-control-panel" value="{{ old('frase2', $institucion->frase2) }}">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="frase3">Descripción 3 del carrusel</label>
                <input type="text" id="frase3" name="frase3" class="form-control-panel" value="{{ old('frase3', $institucion->frase3) }}">
            </div>
            <div class="col-md-6 form-group ">
                <label class="form-label-panel" for="imagen">Logo principal</label>
                <input type="file" id="imagen" name="imagen" class="form-control-panel" accept="image/*" onchange="previewImagen(this, 'previewImgLogo')">
                <div id="previewImgLogoWrapper" style="margin-top:10px; {{ $institucion->imagen ? '' : 'display:none;' }}">
                    <img id="previewImgLogo" src="{{ $institucion->imagen ? asset('imagen/institucion/' . $institucion->imagen) : '' }}" class="img-preview-large">
                </div>
            </div>
        </div>

        {{-- === MISIÓN, VISIÓN Y DESCRIPCIONES === --}}
        <div class="mt-5 mb-4 pb-2 border-bottom">
            <h6 class="fw-bold" style="color: var(--primary);"><i class="fas fa-bullseye me-2"></i> Misión, Visión y texto institucional</h6>
        </div>
        <div class="row g-4">
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="mision">Misión</label>
                <textarea id="mision" name="mision" rows="4" class="form-control-panel">{{ old('mision', $institucion->mision) }}</textarea>
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="vision">Visión</label>
                <textarea id="vision" name="vision" rows="4" class="form-control-panel">{{ old('vision', $institucion->vision) }}</textarea>
            </div>
            <div class="col-12 form-group">
                <label class="form-label-panel" for="qSomos">¿Quiénes somos? (texto completo)</label>
                <textarea id="qSomos" name="qSomos" rows="5" class="form-control-panel">{{ old('qSomos', $institucion->qSomos) }}</textarea>
            </div>
            <div class="col-12 form-group">
                <label class="form-label-panel" for="desEmpresa">Descripción de la empresa (corta)</label>
                <textarea id="desEmpresa" name="desEmpresa" rows="3" class="form-control-panel">{{ old('desEmpresa', $institucion->desEmpresa) }}</textarea>
            </div>
        </div>

        {{-- === SECCIONES DE LA PÁGINA === --}}
        <div class="mt-5 mb-4 pb-2 border-bottom">
            <h6 class="fw-bold" style="color: var(--primary);"><i class="fas fa-newspaper me-2"></i> Contenido de secciones</h6>
        </div>
        <div class="row g-4">
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="tituloactividades">Título de Actividades</label>
                <input type="text" id="tituloactividades" name="tituloactividades" class="form-control-panel" value="{{ old('tituloactividades', $institucion->tituloactividades) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="desactividades">Subtítulo de Actividades</label>
                <input type="text" id="desactividades" name="desactividades" class="form-control-panel" value="{{ old('desactividades', $institucion->desactividades) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="tituloequipo">Título de la sección Equipo</label>
                <input type="text" id="tituloequipo" name="tituloequipo" class="form-control-panel" value="{{ old('tituloequipo', $institucion->tituloequipo) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="desequipo">Subtítulo de Equipo</label>
                <input type="text" id="desequipo" name="desequipo" class="form-control-panel" value="{{ old('desequipo', $institucion->desequipo) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="tituloempresa">Título de Empresas</label>
                <input type="text" id="tituloempresa" name="tituloempresa" class="form-control-panel" value="{{ old('tituloempresa', $institucion->tituloempresa) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="titulosomos">Título "Quiénes somos"</label>
                <input type="text" id="titulosomos" name="titulosomos" class="form-control-panel" value="{{ old('titulosomos', $institucion->titulosomos) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="titulonoticias">Título de la sección Noticias</label>
                <input type="text" id="titulonoticias" name="titulonoticias" class="form-control-panel" value="{{ old('titulonoticias', $institucion->titulonoticias) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="desnoticias">Subtítulo / descripción Noticias</label>
                <input type="text" id="desnoticias" name="desnoticias" class="form-control-panel" value="{{ old('desnoticias', $institucion->desnoticias) }}">
            </div>
        </div>

        {{-- === SECCIÓN "TRABAJA CON NOSOTROS" === --}}
        <div class="mt-5 mb-4 pb-2 border-bottom">
            <h6 class="fw-bold" style="color: var(--primary);"><i class="fas fa-briefcase me-2"></i> Trabaja con nosotros</h6>
        </div>
        <div class="row g-4">
            <div class="col-12 form-group">
                <label class="form-label-panel" for="trabaja">Texto completo de "Trabaja con nosotros"</label>
                <textarea id="trabaja" name="trabaja" rows="4" class="form-control-panel">{{ old('trabaja', $institucion->trabaja) }}</textarea>
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="titulotrabaja">Título de la sección</label>
                <input type="text" id="titulotrabaja" name="titulotrabaja" class="form-control-panel" value="{{ old('titulotrabaja', $institucion->titulotrabaja) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="imgtrabaja">Imagen para "Trabaja con nosotros"</label>
                <input type="file" id="imgtrabaja" name="imgtrabaja" class="form-control-panel" accept="image/*" onchange="previewImagen(this, 'previewImgTrabaja')">
                <small>Dejar vacío para conservar la actual.</small>
                <div id="previewImgTrabajaWrapper" style="margin-top:10px; {{ $institucion->imgtrabaja ? '' : 'display:none;' }}">
                    <img id="previewImgTrabaja" src="{{ $institucion->imgtrabaja ? asset('imagen/institucion/' . $institucion->imgtrabaja) : '' }}" class="img-preview-large">
                </div>
            </div>
        </div>

        {{-- === PLANES / SUSCRIPCIÓN (Tarjeta FaceBol) === --}}
        <div class="mt-5 mb-4 pb-2 border-bottom">
            <h6 class="fw-bold" style="color: var(--primary);"><i class="fas fa-credit-card me-2"></i> Planes y suscripción</h6>
        </div>
        <div class="row g-4">
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="tituloplan">Título de la sección Planes</label>
                <input type="text" id="tituloplan" name="tituloplan" class="form-control-panel" value="{{ old('tituloplan', $institucion->tituloplan) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="desplan">Descripción de la sección Planes</label>
                <input type="text" id="desplan" name="desplan" class="form-control-panel" value="{{ old('desplan', $institucion->desplan) }}">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="nombreplan">Nombre del plan</label>
                <input type="text" id="nombreplan" name="nombreplan" class="form-control-panel" value="{{ old('nombreplan', $institucion->nombreplan) }}">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="bsprecio">Precio básico</label>
                <input type="text" id="bsprecio" name="bsprecio" class="form-control-panel" value="{{ old('bsprecio', $institucion->bsprecio) }}" placeholder="Ej: 50 Bs">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="susprecio">Precio suscripción</label>
                <input type="text" id="susprecio" name="susprecio" class="form-control-panel" value="{{ old('susprecio', $institucion->susprecio) }}" placeholder="Ej: 30 Bs/mes">
            </div>
            <div class="col-12 form-group">
                <label class="form-label-panel" for="plan">Descripción larga del plan</label>
                <textarea id="plan" name="plan" rows="3" class="form-control-panel">{{ old('plan', $institucion->plan) }}</textarea>
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="benplan1">Beneficio 1</label>
                <input type="text" id="benplan1" name="benplan1" class="form-control-panel" value="{{ old('benplan1', $institucion->benplan1) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="benplan2">Beneficio 2</label>
                <input type="text" id="benplan2" name="benplan2" class="form-control-panel" value="{{ old('benplan2', $institucion->benplan2) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="benplan3">Beneficio 3</label>
                <input type="text" id="benplan3" name="benplan3" class="form-control-panel" value="{{ old('benplan3', $institucion->benplan3) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="benplan4">Beneficio 4</label>
                <input type="text" id="benplan4" name="benplan4" class="form-control-panel" value="{{ old('benplan4', $institucion->benplan4) }}">
            </div>
            <div class="col-md-12 form-group">
                <label class="form-label-panel" for="benplan5">Beneficio 5</label>
                <input type="text" id="benplan5" name="benplan5" class="form-control-panel" value="{{ old('benplan5', $institucion->benplan5) }}">
            </div>
        </div>

        {{-- === SECCIÓN SUSCRIPCIÓN === --}}
        <div class="mt-5 mb-4 pb-2 border-bottom">
            <h6 class="fw-bold" style="color: var(--primary);"><i class="fas fa-envelope-open-text me-2"></i> Suscripción / Newsletter</h6>
        </div>
        <div class="row g-4">
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="titulosuscribir">Título del formulario de suscripción</label>
                <input type="text" id="titulosuscribir" name="titulosuscribir" class="form-control-panel" value="{{ old('titulosuscribir', $institucion->titulosuscribir) }}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="dessuscribir">Descripción del formulario</label>
                <textarea id="dessuscribir" name="dessuscribir" rows="2" class="form-control-panel">{{ old('dessuscribir', $institucion->dessuscribir) }}</textarea>
            </div>
        </div>

        {{-- Botones --}}
        <div class="d-flex gap-3 mt-5 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-save"></i> Guardar cambios</button>
            <a href="{{ route('indexEquipo') }}" class="btn-accent-panel">Cancelar</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImagen(input, previewId) {
        const wrapper = document.getElementById(previewId + 'Wrapper');
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                wrapper.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
        }
    }
</script>
@endpush
@endsection
@extends('panel.layout')
@section('titulo', 'Editar empresa')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('indexEmpresa') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a empresas
    </a>
</div>

<div class="panel-card" style="max-width: 900px;">
    <div class="panel-card-header">
        <h5><i class="fas fa-edit me-2"></i> Editar empresa: {{ $empresa->nombre }}</h5>
    </div>

    {{-- Mostrar errores de validación generales --}}
    @if($errors->any())
        <div class="alert alert-danger mx-3 mt-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('actualizarEmpresa', $empresa) }}" enctype="multipart/form-data" style="padding: 28px;">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Nombre (requerido) --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="nombre">Nombre <span class="text-danger">*</span></label>
                <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre', $empresa->nombre) }}" required maxlength="255" placeholder="Ej: Empresa Ejemplo SRL">
                @error('nombre')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Categoría (requerido) --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="categoria_id">Categoría <span class="text-danger">*</span></label>
                <select id="categoria_id" name="categoria_id" class="form-control-panel @error('categoria_id') is-invalid @enderror" required>
                    <option value="" disabled>-- Seleccionar --</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ old('categoria_id', $empresa->categoria_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Ciudad (requerido) --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="ciudad_id">Ciudad <span class="text-danger">*</span></label>
                <select id="ciudad_id" name="ciudad_id" class="form-control-panel @error('ciudad_id') is-invalid @enderror" required>
                    <option value="" disabled>-- Seleccionar --</option>
                    @foreach($ciudades as $ciu)
                        <option value="{{ $ciu->id }}" {{ old('ciudad_id', $empresa->ciudad_id) == $ciu->id ? 'selected' : '' }}>{{ $ciu->nombre }}</option>
                    @endforeach
                </select>
                @error('ciudad_id')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Prioridad --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="prioridad">Prioridad (menor = más arriba)</label>
                <input type="number" id="prioridad" name="prioridad" class="form-control-panel" value="{{ old('prioridad', $empresa->prioridad) }}" min="0" placeholder="0, 1, 2...">
            </div>

            {{-- Descripción (requerido) --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="descripcion">Descripción <span class="text-danger">*</span></label>
                <textarea id="descripcion" name="descripcion" rows="3" class="form-control-panel @error('descripcion') is-invalid @enderror" required placeholder="Breve descripción de la empresa y sus servicios...">{{ old('descripcion', $empresa->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Dirección (requerido) --}}
            <div class="col-md-8 form-group">
                <label class="form-label-panel" for="direccion">Dirección <span class="text-danger">*</span></label>
                <input type="text" id="direccion" name="direccion" class="form-control-panel @error('direccion') is-invalid @enderror" value="{{ old('direccion', $empresa->direccion) }}" required placeholder="Calle, número, zona, ciudad">
                @error('direccion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Horario (requerido) --}}
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="horario">Horario <span class="text-danger">*</span></label>
                <input type="text" id="horario" name="horario" class="form-control-panel @error('horario') is-invalid @enderror" value="{{ old('horario', $empresa->horario) }}" required placeholder="Ej: Lun-Vie 9:00-18:00">
                @error('horario')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Teléfono --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control-panel" value="{{ old('telefono', $empresa->telefono) }}" placeholder="Ej: 2XXXXXX o 7XXXXXXX">
            </div>

            {{-- Email --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control-panel" value="{{ old('email', $empresa->email) }}" placeholder="contacto@empresa.com">
            </div>

            {{-- Web --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="web">Sitio web</label>
                <input type="url" id="web" name="web" class="form-control-panel" value="{{ old('web', $empresa->web) }}" placeholder="https://www.empresa.com">
            </div>

            {{-- Facebook --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="facebook">Facebook</label>
                <input type="url" id="facebook" name="facebook" class="form-control-panel" value="{{ old('facebook', $empresa->facebook) }}" placeholder="https://facebook.com/empresa">
            </div>

            {{-- Promoción --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="promocion">Promoción</label>
                <input type="text" id="promocion" name="promocion" class="form-control-panel" value="{{ old('promocion', $empresa->promocion) }}" placeholder="Ej: 2x1, 20% off, etc.">
            </div>

            {{-- Descuento --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="descuento">Descuento</label>
                <input type="text" id="descuento" name="descuento" class="form-control-panel" value="{{ old('descuento', $empresa->descuento) }}" placeholder="Ej: 10% con tarjeta FaceBol">
            </div>

            {{-- Código de video --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="video">Código de video (embed)</label>
                <input type="text" id="video" name="video" class="form-control-panel" value="{{ old('video', $empresa->video) }}" placeholder="Código iframe o ID de YouTube">
            </div>

            {{-- Video destacado --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="videof">Video destacado (URL)</label>
                <input type="url" id="videof" name="videof" class="form-control-panel" value="{{ old('videof', $empresa->videof) }}" placeholder="https://www.youtube.com/watch?v=...">
            </div>

            {{-- Imagen principal (opcional en edición) --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen">Logo / Imagen principal</label>
                <input type="file" id="imagen" name="imagen" class="form-control-panel @error('imagen') is-invalid @enderror" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImagen(this, 'previewImg')">
                <small>Formatos: JPG, PNG, WEBP. Máx 2MB. Dejar vacío para conservar la actual.</small>
                <div id="previewImgWrapper" style="margin-top:10px; {{ $empresa->imagen ? '' : 'display:none;' }}">
                    <img id="previewImg" src="{{ $empresa->imagen ? asset('imagen/empresas/' . $empresa->imagen) : '' }}" class="img-preview-large" style="max-width:180px;">
                </div>
                @error('imagen')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen adicional (opcional) --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen1">Imagen adicional (galería)</label>
                <input type="file" id="imagen1" name="imagen1" class="form-control-panel" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImagen(this, 'previewImg1')">
                <div id="previewImg1Wrapper" style="margin-top:10px; {{ $empresa->imagen1 ? '' : 'display:none;' }}">
                    <img id="previewImg1" src="{{ $empresa->imagen1 ? asset('imagen/empresasproductos/' . $empresa->imagen1) : '' }}" class="img-preview-large" style="max-width:180px;">
                </div>
                @error('imagen1')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Coordenadas --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="latitud">Latitud</label>
                <input type="number" step="any" id="latitud" name="latitud" class="form-control-panel" value="{{ old('latitud', $empresa->latitud) }}" placeholder="-16.5000">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="longitud">Longitud</label>
                <input type="number" step="any" id="longitud" name="longitud" class="form-control-panel" value="{{ old('longitud', $empresa->longitud) }}" placeholder="-68.1500">
            </div>

            {{-- Código de mapa --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="mapa">Código de mapa (iframe)</label>
                <textarea id="mapa" name="mapa" rows="2" class="form-control-panel" placeholder='<iframe src="https://maps.google.com/..."></iframe>'>{{ old('mapa', $empresa->mapa) }}</textarea>
            </div>
        </div>

        <div class="d-flex gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-sync-alt"></i> Actualizar empresa</button>
            <a href="{{ route('indexEmpresa') }}" class="btn-accent-panel">Cancelar</a>
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
            const currentSrc = preview.getAttribute('data-current-src');
            if (currentSrc) preview.src = currentSrc;
            else wrapper.style.display = 'none';
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        let previewImg = document.getElementById('previewImg');
        if (previewImg && previewImg.src) previewImg.setAttribute('data-current-src', previewImg.src);
        let previewImg1 = document.getElementById('previewImg1');
        if (previewImg1 && previewImg1.src) previewImg1.setAttribute('data-current-src', previewImg1.src);
    });
</script>
@endpush
@endsection
@extends('panel.layout')
@section('titulo', 'Nueva empresa')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('indexEmpresa') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a empresas
    </a>
</div>

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-plus-circle me-2"></i> Nueva empresa</h5>
    </div>

    <form method="POST" action="{{ route('guardarEmpresa') }}" enctype="multipart/form-data" style="padding: 28px;">
        @csrf

        {{-- Mensaje de errores generales --}}
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            {{-- Nombre --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="nombre">Nombre <span class="text-danger">*</span></label>
                <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required maxlength="255" placeholder="Ej: Empresa Ejemplo SRL">
                @error('nombre')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Categoría --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="categoria_id">Categoría <span class="text-danger">*</span></label>
                <select id="categoria_id" name="categoria_id" class="form-control-panel @error('categoria_id') is-invalid @enderror" required>
                    <option value="">-- Seleccionar --</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Ciudad --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="ciudad_id">Ciudad <span class="text-danger">*</span></label>
                <select id="ciudad_id" name="ciudad_id" class="form-control-panel @error('ciudad_id') is-invalid @enderror" required>
                    <option value="">-- Seleccionar --</option>
                    @foreach($ciudades as $ciu)
                        <option value="{{ $ciu->id }}" {{ old('ciudad_id') == $ciu->id ? 'selected' : '' }}>{{ $ciu->nombre }}</option>
                    @endforeach
                </select>
                @error('ciudad_id')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Prioridad --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="prioridad">Prioridad (menor = más arriba)</label>
                <input type="number" id="prioridad" name="prioridad" class="form-control-panel" value="{{ old('prioridad', 0) }}" min="0" placeholder="0, 1, 2...">
            </div>

            {{-- Descripción --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="descripcion">Descripción <span class="text-danger">*</span></label>
                <textarea id="descripcion" name="descripcion" rows="3" class="form-control-panel @error('descripcion') is-invalid @enderror" required placeholder="Breve descripción de la empresa y sus servicios...">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Dirección --}}
            <div class="col-md-8 form-group">
                <label class="form-label-panel" for="direccion">Dirección <span class="text-danger">*</span></label>
                <input type="text" id="direccion" name="direccion" class="form-control-panel @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}" required placeholder="Calle, número, zona, ciudad">
                @error('direccion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Horario --}}
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="horario">Horario <span class="text-danger">*</span></label>
                <input type="text" id="horario" name="horario" class="form-control-panel @error('horario') is-invalid @enderror" value="{{ old('horario') }}" required placeholder="Ej: Lun-Vie 9:00-18:00">
                @error('horario')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Teléfono --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control-panel" value="{{ old('telefono') }}" placeholder="Ej: 2XXXXXX o 7XXXXXXX">
            </div>

            {{-- Email --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control-panel" value="{{ old('email') }}" placeholder="contacto@empresa.com">
            </div>

            {{-- Web --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="web">Sitio web</label>
                <input type="url" id="web" name="web" class="form-control-panel" value="{{ old('web') }}" placeholder="https://www.empresa.com">
            </div>

            {{-- Facebook --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="facebook">Facebook</label>
                <input type="url" id="facebook" name="facebook" class="form-control-panel" value="{{ old('facebook') }}" placeholder="https://facebook.com/empresa">
            </div>

            {{-- Promoción --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="promocion">Promoción</label>
                <input type="text" id="promocion" name="promocion" class="form-control-panel" value="{{ old('promocion') }}" placeholder="Ej: 2x1, 20% off, etc.">
            </div>

            {{-- Descuento --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="descuento">Descuento</label>
                <input type="text" id="descuento" name="descuento" class="form-control-panel" value="{{ old('descuento') }}" placeholder="Ej: 10% con tarjeta FaceBol">
            </div>

            {{-- Código de video --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="video">Código de video (embed)</label>
                <input type="text" id="video" name="video" class="form-control-panel" value="{{ old('video') }}" placeholder="Código iframe o ID de YouTube">
            </div>

            {{-- Video destacado --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="videof">Video destacado (URL)</label>
                <input type="url" id="videof" name="videof" class="form-control-panel" value="{{ old('videof') }}" placeholder="https://www.youtube.com/watch?v=...">
            </div>

            {{-- Imagen principal --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen">Logo / Imagen principal <span class="text-danger">*</span></label>
                <input type="file" id="imagen" name="imagen" class="form-control-panel @error('imagen') is-invalid @enderror" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImagen(this, 'previewImg')" required>
                <small>Formatos: JPG, PNG, WEBP. Máx 2MB.</small>
                <div id="previewImgWrapper" style="margin-top:10px; display:none;">
                    <img id="previewImg" src="" class="img-preview-large" style="max-width:180px;">
                </div>
                @error('imagen')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen adicional --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen1">Imagen adicional</label>
                <input type="file" id="imagen1" name="imagen1" class="form-control-panel" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImagen(this, 'previewImg1')">
                <div id="previewImg1Wrapper" style="margin-top:10px; display:none;">
                    <img id="previewImg1" src="" class="img-preview-large" style="max-width:180px;">
                </div>
                @error('imagen1')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Latitud --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="latitud">Latitud</label>
                <input type="number" step="any" id="latitud" name="latitud" class="form-control-panel" value="{{ old('latitud') }}" placeholder="-16.5000">
            </div>

            {{-- Longitud --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="longitud">Longitud</label>
                <input type="number" step="any" id="longitud" name="longitud" class="form-control-panel" value="{{ old('longitud') }}" placeholder="-68.1500">
            </div>

            {{-- Mapa --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="mapa">Código de mapa (iframe)</label>
                <textarea id="mapa" name="mapa" rows="2" class="form-control-panel" placeholder='<iframe src="https://maps.google.com/..."></iframe>' >{{ old('mapa') }}</textarea>
            </div>
        </div>

        <div class="d-flex gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-save"></i> Guardar empresa</button>
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
            wrapper.style.display = 'none';
        }
    }
</script>
@endpush
@endsection
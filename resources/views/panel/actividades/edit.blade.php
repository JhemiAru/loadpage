@extends('panel.layout')
@section('titulo', 'Editar actividad')

@section('content')
<div style="margin-bottom:20px;font-size:0.85rem;">
    <a href="{{ route('indexActividad') }}"
       style="color:var(--blue-light);text-decoration:none;font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a actividades
    </a>
</div>

<div class="panel-card" style="max-width:720px;">
    <div class="panel-card-header">
        <h5><i class="fas fa-edit me-2"></i> Editar actividad</h5>
    </div>

    <form method="POST"
          action="{{ route('actualizarActividad', $actividad->id) }}"
          enctype="multipart/form-data"
          style="padding:28px;">
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- Nombre --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="nombre">
                    Nombre <span style="color:#dc2626;">*</span>
                </label>
                <input type="text"
                       id="nombre" name="nombre"
                       class="form-control-panel @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $actividad->nombre) }}"
                       placeholder="Ej: Taller de emprendimiento"
                       maxlength="255"
                       required>
                @error('nombre')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipo --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="tipo">
                    Tipo <span style="color:#dc2626;">*</span>
                </label>
                <select id="tipo" name="tipo"
                        class="form-control-panel @error('tipo') is-invalid @enderror"
                        required>
                    <option value="" disabled {{ old('tipo', $actividad->tipo) ? '' : 'selected' }}>-- Seleccionar --</option>
                    <option value="actividad" {{ old('tipo', $actividad->tipo) == 'actividad' ? 'selected' : '' }}>Actividad</option>
                    <option value="noticia" {{ old('tipo', $actividad->tipo) == 'noticia' ? 'selected' : '' }}>Noticia</option>
                </select>
                @error('tipo')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Fecha --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="fecha">
                    Fecha <span style="color:#dc2626;">*</span>
                </label>
                <input type="date"
                       id="fecha" name="fecha"
                       class="form-control-panel @error('fecha') is-invalid @enderror"
                       value="{{ old('fecha', $actividad->fecha?->format('Y-m-d')) }}"
                       required>
                @error('fecha')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción  --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="descripcion">
                    Descripción <span style="color:#dc2626;">*</span>
                </label>
                <textarea id="descripcion" name="descripcion"
                          class="form-control-panel @error('descripcion') is-invalid @enderror"
                          rows="4"
                          placeholder="Descripción de la actividad..."
                          required>{{ old('descripcion', $actividad->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen">Imagen</label>
                <input type="file"
                       id="imagen" name="imagen"
                       class="form-control-panel @error('imagen') is-invalid @enderror"
                       accept="image/jpg,image/jpeg,image/png,image/webp"
                       onchange="previewImg(this)">
                <small style="color:var(--text-muted);font-size:0.78rem;">
                    JPG, PNG o WEBP. Máximo 2 MB. Dejar vacío para conservar la imagen actual.
                </small>
                @error('imagen')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror

                {{-- Vista previa: imagen actual o nueva seleccionada --}}
                <div id="preview-wrapper"
                     style="margin-top:12px;display:{{ $actividad->imagen ? 'block' : 'none' }};">
                    <small style="display:block;color:var(--text-muted);margin-bottom:6px;">
                        Vista previa:
                    </small>
                    <img id="img-preview"
                         src="{{ $actividad->imagen ? asset('imagen/actividades/' . $actividad->imagen) : '' }}"
                         alt="Vista previa"
                         class="img-preview-large">
                </div>
            </div>

            {{-- Activo (checkbox, opcional) --}}
            <div class="col-12 form-group">
                <label class="form-label-panel">Estado</label>
                <div style="display:flex;align-items:center;gap:12px;margin-top:4px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:0.9rem;">
                        <input type="checkbox"
                               name="activo"
                               value="1"
                               {{ old('activo', $actividad->activo) ? 'checked' : '' }}
                               style="width:16px;height:16px;accent-color:var(--primary);">
                        Publicar actividad (visible en el sitio)
                    </label>
                </div>
            </div>

        </div>

        {{-- Acciones --}}
        <div style="display:flex;gap:12px;margin-top:8px;padding-top:20px;border-top:1px solid #f0f3f9;">
            <button type="submit" class="btn-primary-panel">
                <i class="fas fa-sync-alt"></i> Actualizar actividad
            </button>
            <a href="{{ route('indexActividad') }}" class="btn-accent-panel">Cancelar</a>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImg(input) {
        const wrapper = document.getElementById('preview-wrapper');
        const preview = document.getElementById('img-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                wrapper.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            @if($actividad->imagen)
                preview.src = "{{ asset('imagen/actividades/' . $actividad->imagen) }}";
                wrapper.style.display = 'block';
            @else
                wrapper.style.display = 'none';
            @endif
        }
    }
</script>
@endpush
@extends('panel.layout')
@section('titulo', 'Nuevo taller')

@section('content')

{{-- Breadcrumb --}}
<div style="margin-bottom: 20px; font-size: 0.85rem; color: var(--text-muted);">
    <a href="{{ route('indexTaller') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a talleres
    </a>
</div>

<div class="panel-card" style="max-width: 780px;">
    <div class="panel-card-header">
        <h5><i class="fas fa-plus-circle me-2"></i> Nuevo taller</h5>
    </div>

    <form method="POST"
          action="{{ route('guardarTaller') }}"
          enctype="multipart/form-data"
          style="padding: 28px;">

        @csrf

        <div class="row g-4">

            {{-- Título --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="titulo">Título <span style="color:#dc2626;">*</span></label>
                <input type="text"
                       id="titulo"
                       name="titulo"
                       class="form-control-panel @error('titulo') is-invalid @enderror"
                       value="{{ old('titulo') }}"
                       placeholder="Ej: Taller de Marketing Digital"
                       maxlength="255">
                @error('titulo')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="descripcion">Descripción <span style="color:#dc2626;">*</span></label>
                <textarea id="descripcion"
                          name="descripcion"
                          class="form-control-panel @error('descripcion') is-invalid @enderror"
                          rows="3"
                          placeholder="Descripción breve del taller...">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Fecha / Horario --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="fecha">Fecha <span style="color:#dc2626;">*</span></label>
                <input type="date"
                       id="fecha"
                       name="fecha"
                       class="form-control-panel @error('fecha') is-invalid @enderror"
                       value="{{ old('fecha') }}">
                @error('fecha')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="horario">Horario <span style="color:#dc2626;">*</span></label>
                <input type="text"
                       id="horario"
                       name="horario"
                       class="form-control-panel @error('horario') is-invalid @enderror"
                       value="{{ old('horario') }}"
                       placeholder="Ej: 09:00 - 13:00 hs"
                       maxlength="255">
                @error('horario')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Lugar / Costo --}}
            <div class="col-md-8 form-group">
                <label class="form-label-panel" for="lugar">Lugar <span style="color:#dc2626;">*</span></label>
                <input type="text"
                       id="lugar"
                       name="lugar"
                       class="form-control-panel @error('lugar') is-invalid @enderror"
                       value="{{ old('lugar') }}"
                       placeholder="Ej: Salón principal, Av. Chacaltaya #50"
                       maxlength="500">
                @error('lugar')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="costo">Costo (Bs.) <span style="color:#dc2626;">*</span></label>
                <input type="number"
                       id="costo"
                       name="costo"
                       class="form-control-panel @error('costo') is-invalid @enderror"
                       value="{{ old('costo') }}"
                       placeholder="0.00"
                       step="0.01"
                       min="0">
                @error('costo')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen">Imagen del taller</label>
                <input type="file"
                       id="imagen"
                       name="imagen"
                       class="form-control-panel @error('imagen') is-invalid @enderror"
                       accept="image/jpg,image/jpeg,image/png,image/webp"
                       onchange="previewImagen(this)">
                <small style="color:var(--text-muted); font-size:0.78rem;">
                    Formatos: JPG, PNG, WEBP. Máximo 2 MB.
                </small>
                @error('imagen')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
                <div id="preview-wrapper" style="margin-top:10px; display:none;">
                    <img id="img-preview" src="" alt="Vista previa" class="img-preview-large">
                </div>
            </div>

            {{-- Detalles --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="detalles">Detalles adicionales</label>
                <textarea id="detalles"
                          name="detalles"
                          class="form-control-panel @error('detalles') is-invalid @enderror"
                          rows="4"
                          placeholder="Información adicional: requisitos, materiales, certificación...">{{ old('detalles') }}</textarea>
                @error('detalles')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Acciones --}}
        <div style="display:flex; gap:12px; margin-top:8px; padding-top:20px; border-top:1px solid #f0f3f9;">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-save"></i> Guardar taller</button>
            <a href="{{ route('indexTaller') }}" class="btn-accent-panel">Cancelar</a>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script>
    function previewImagen(input) {
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
            wrapper.style.display = 'none';
        }
    }
</script>
@endpush

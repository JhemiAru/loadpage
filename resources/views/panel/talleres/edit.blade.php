@extends('panel.layout')
@section('titulo', 'Editar taller')

@section('content')

<div style="margin-bottom: 20px; font-size: 0.85rem; color: var(--text-muted);">
    <a href="{{ route('indexTaller') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a talleres
    </a>
</div>

<div class="panel-card" style="max-width: 780px;">
    <div class="panel-card-header">
        <h5><i class="fas fa-edit me-2"></i> Editar taller</h5>
    </div>

    <form method="POST"
          action="{{ route('actualizarTaller', $taller->id) }}"
          enctype="multipart/form-data"
          style="padding: 28px;">

        @csrf
        @method('PUT') 

        <div class="row g-4">

            {{-- Título --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="titulo">Título <span class="text-danger">*</span></label>
                <input type="text"
                       id="titulo"
                       name="titulo"
                       class="form-control-panel @error('titulo') is-invalid @enderror"
                       value="{{ old('titulo', $taller->titulo) }}"
                       placeholder="Ej: Taller de Marketing Digital"
                       maxlength="255"
                       required>
                @error('titulo')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="descripcion">Descripción <span class="text-danger">*</span></label>
                <textarea id="descripcion"
                          name="descripcion"
                          class="form-control-panel @error('descripcion') is-invalid @enderror"
                          rows="3"
                          placeholder="Descripción breve del taller..."
                          required>{{ old('descripcion', $taller->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Fecha / Horario --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="fecha">Fecha <span class="text-danger">*</span></label>
                <input type="date"
                       id="fecha"
                       name="fecha"
                       class="form-control-panel @error('fecha') is-invalid @enderror"
                       value="{{ old('fecha', $taller->fecha ? $taller->fecha->format('Y-m-d') : '') }}"
                       required>
                @error('fecha')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="horario">Horario <span class="text-danger">*</span></label>
                <input type="text"
                       id="horario"
                       name="horario"
                       class="form-control-panel @error('horario') is-invalid @enderror"
                       value="{{ old('horario', $taller->horario) }}"
                       placeholder="Ej: 09:00 - 13:00 hs"
                       maxlength="255"
                       required>
                @error('horario')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Lugar / Costo --}}
            <div class="col-md-8 form-group">
                <label class="form-label-panel" for="lugar">Lugar <span class="text-danger">*</span></label>
                <input type="text"
                       id="lugar"
                       name="lugar"
                       class="form-control-panel @error('lugar') is-invalid @enderror"
                       value="{{ old('lugar', $taller->lugar) }}"
                       placeholder="Ej: Salón principal, Av. Chacaltaya #50"
                       maxlength="500"
                       required>
                @error('lugar')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="costo">Costo (Bs.) <span class="text-danger">*</span></label>
                <input type="number"
                       id="costo"
                       name="costo"
                       class="form-control-panel @error('costo') is-invalid @enderror"
                       value="{{ old('costo', $taller->costo) }}"
                       placeholder="0.00"
                       step="0.01"
                       min="0"
                       required>
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
                    Formatos: JPG, PNG, WEBP. Máximo 2 MB. Dejar vacío para conservar la imagen actual.
                </small>
                @error('imagen')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
                
                <div id="preview-wrapper" style="margin-top:15px; display: {{ $taller->imagen ? 'block' : 'none' }};">
                    <span style="display:block; font-size:0.8rem; margin-bottom:5px; color:var(--text-muted);">Vista previa:</span>
                    <img id="img-preview" 
                         src="{{ $taller->imagen ? asset('imagen/talleres/' . $taller->imagen) : '' }}" 
                         alt="Vista previa" 
                         class="img-preview-large" 
                         style="max-width:200px; border-radius:8px; border:1px solid #dde2ee;">
                </div>
            </div>

            {{-- Detalles --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="detalles">Detalles adicionales</label>
                <textarea id="detalles"
                          name="detalles"
                          class="form-control-panel @error('detalles') is-invalid @enderror"
                          rows="4"
                          placeholder="Información adicional: requisitos, materiales, certificación...">{{ old('detalles', $taller->detalles) }}</textarea>
                @error('detalles')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Acciones --}}
        <div style="display:flex; gap:12px; margin-top:8px; padding-top:20px; border-top:1px solid #f0f3f9;">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-sync-alt"></i> Actualizar taller</button>
            <a href="{{ route('indexTaller') }}" class="btn-accent-panel">Cancelar</a>
        </div>

    </form>
</div>

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
            @if($taller->imagen)
                preview.src = "{{ asset('imagen/talleres/' . $taller->imagen) }}";
                wrapper.style.display = 'block';
            @else
                wrapper.style.display = 'none';
            @endif
        }
    }
</script>
@endpush

@endsection
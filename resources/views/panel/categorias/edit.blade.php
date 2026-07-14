@extends('panel.layout')
@section('titulo', 'Editar categoría')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('indexCategoria') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a categorías
    </a>
</div>

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-edit me-2"></i> Editar categoría: {{ $categoria->nombre }}</h5>
    </div>

    <form method="POST" action="{{ route('actualizarCategoria', $categoria) }}" enctype="multipart/form-data" style="padding: 28px;">
        @csrf
        @method('PUT')

        <div class="row g-4">
            {{-- Nombre --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="nombre">Nombre <span class="text-danger">*</span></label>
                <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre', $categoria->nombre) }}" required maxlength="255" placeholder="Ej: Restaurantes, Tecnología, Salud...">
                @error('nombre')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Icono --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="icono">Icono (Font Awesome)</label>
                <input type="text" id="icono" name="icono" class="form-control-panel" value="{{ old('icono', $categoria->icono) }}" placeholder="Ej: fas fa-utensils, fas fa-laptop-code...">
                <small style="color:var(--text-muted);">Clase completa de Font Awesome. <a href="https://fontawesome.com/v6/search" target="_blank">Ver iconos</a></small>
                @error('icono')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="descripcion">Descripción <span class="text-danger">*</span></label>
                <textarea id="descripcion" name="descripcion" rows="3" class="form-control-panel @error('descripcion') is-invalid @enderror" required placeholder="Breve descripción de la categoría...">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Imagen actual --}}
            @if($categoria->imagen)
                <div class="col-12 form-group">
                    <label class="form-label-panel">Imagen actual</label>
                    <div>
                        <img src="{{ asset('imagen/categorias/' . $categoria->imagen) }}" class="img-preview-large" style="max-width:150px;">
                    </div>
                </div>
            @endif

            {{-- Nueva imagen --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen">Cambiar imagen (opcional)</label>
                <input type="file" id="imagen" name="imagen" class="form-control-panel @error('imagen') is-invalid @enderror" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImagen(this)">
                <small>Formatos: JPG, PNG, WEBP. Máx 2MB. Dejar vacío para conservar la actual.</small>
                <div id="preview-wrapper" style="margin-top:10px; display:none;">
                    <img id="img-preview" src="" class="img-preview-large" style="max-width:180px;">
                </div>
                @error('imagen')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="d-flex gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-sync-alt"></i> Actualizar categoría</button>
            <a href="{{ route('indexCategoria') }}" class="btn-accent-panel">Cancelar</a>
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
            wrapper.style.display = 'none';
        }
    }
</script>
@endpush
@endsection
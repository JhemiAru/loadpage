@extends('panel.layout')
@section('titulo', 'Nuevo miembro')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('indexEquipo') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver al equipo
    </a>
</div>

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-plus-circle me-2"></i> Nuevo miembro del equipo</h5>
    </div>

    <form method="POST" action="{{ route('guardarEquipo') }}" enctype="multipart/form-data" style="padding: 28px;">
        @csrf

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
                <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required maxlength="255" placeholder="Ej: Juan Pérez">
                @error('nombre')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Cargo --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="cargo">Cargo <span class="text-danger">*</span></label>
                <input type="text" id="cargo" name="cargo" class="form-control-panel @error('cargo') is-invalid @enderror" value="{{ old('cargo') }}" required maxlength="255" placeholder="Ej: Director de Marketing">
                @error('cargo')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="descripcion">Descripción <span class="text-danger">*</span></label>
                <textarea id="descripcion" name="descripcion" rows="3" class="form-control-panel @error('descripcion') is-invalid @enderror" required placeholder="Breve biografía o descripción...">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Redes sociales --}}
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="facebook">Facebook</label>
                <input type="url" id="facebook" name="facebook" class="form-control-panel" value="{{ old('facebook') }}" placeholder="https://facebook.com/usuario">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="twitter">Twitter / X</label>
                <input type="url" id="twitter" name="twitter" class="form-control-panel" value="{{ old('twitter') }}" placeholder="https://twitter.com/usuario">
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="instagram">Instagram</label>
                <input type="url" id="instagram" name="instagram" class="form-control-panel" value="{{ old('instagram') }}" placeholder="https://instagram.com/usuario">
            </div>

            {{-- Imagen --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen">Imagen <span class="text-danger">*</span></label>
                <input type="file" id="imagen" name="imagen" class="form-control-panel @error('imagen') is-invalid @enderror" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImagen(this, 'previewImg')" required>
                <small>Formatos: JPG, PNG, WEBP. Máx 2MB.</small>
                <div id="previewImgWrapper" style="margin-top:10px; display:none;">
                    <img id="previewImg" src="" class="img-preview-large" style="max-width:180px;">
                </div>
                @error('imagen')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Estado --}}
            <div class="col-12 form-group">
                <label class="form-label-panel">Estado</label>
                <div style="display:flex;align-items:center;gap:12px;margin-top:4px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:0.9rem;">
                        <input type="checkbox" name="estado" value="1" {{ old('estado', true) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--primary);">
                        Activo (visible en el sitio)
                    </label>
                </div>
            </div>
        </div>

        <div class="d-flex gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-save"></i> Guardar miembro</button>
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
            wrapper.style.display = 'none';
        }
    }
</script>
@endpush
@endsection
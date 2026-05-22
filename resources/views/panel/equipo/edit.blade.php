@extends('panel.layout')
@section('titulo', 'Editar miembro')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('indexEquipo') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver al equipo
    </a>
</div>

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-edit me-2"></i> Editar miembro: {{ $equipo->nombre }}</h5>
    </div>

    <form method="POST" action="{{ route('actualizarEquipo', $equipo) }}" enctype="multipart/form-data" style="padding: 28px;">
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

        <div class="row g-4">
            {{-- Nombre --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="nombre">Nombre <span class="text-danger">*</span></label>
                <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre', $equipo->nombre) }}" required maxlength="255" placeholder="Ej: Juan Pérez">
                @error('nombre')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Cargo --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="cargo">Cargo <span class="text-danger">*</span></label>
                <input type="text" id="cargo" name="cargo" class="form-control-panel @error('cargo') is-invalid @enderror" value="{{ old('cargo', $equipo->cargo) }}" required maxlength="255" placeholder="Ej: Director de Marketing">
                @error('cargo')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="descripcion">Descripción <span class="text-danger">*</span></label>
                <textarea id="descripcion" name="descripcion" rows="3" class="form-control-panel @error('descripcion') is-invalid @enderror" required placeholder="Breve biografía o descripción...">{{ old('descripcion', $equipo->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Redes sociales --}}
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="facebook">Facebook</label>
                <input type="url" id="facebook" name="facebook" class="form-control-panel" placeholder="https://facebook.com/usuario">
                @error('facebook')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="twitter">Twitter / X</label>
                <input type="url" id="twitter" name="twitter" class="form-control-panel" value="{{ old('twitter', $equipo->twitter) }}" placeholder="https://twitter.com/usuario">
                @error('twitter')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="instagram">Instagram</label>
                <input type="url" id="instagram" name="instagram" class="form-control-panel" value="{{ old('instagram', $equipo->instagram) }}" placeholder="https://instagram.com/usuario">
                @error('instagram')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            {{-- Imagen --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" class="form-control-panel" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImagen(this, 'previewImg')">
                <small>Dejar vacío para conservar la imagen actual. Formatos: JPG, PNG, WEBP. Máx 2MB.</small>
                <div id="previewImgWrapper" style="margin-top:10px; {{ $equipo->imagen ? '' : 'display:none;' }}">
                    <img id="previewImg" src="{{ $equipo->imagen ? asset('imagen/equipos/' . $equipo->imagen) : '' }}" class="img-preview-large" style="max-width:180px;">
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
                        <input type="checkbox" name="estado" value="1" {{ old('estado', $equipo->estado) ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--primary);">
                        Activo (visible en el sitio)
                    </label>
                </div>
            </div>
        </div>

        <div class="d-flex gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-sync-alt"></i> Actualizar miembro</button>
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
            @if($equipo->imagen)
                preview.src = "{{ asset('imagen/equipos/' . $equipo->imagen) }}";
                wrapper.style.display = 'block';
            @else
                wrapper.style.display = 'none';
            @endif
        }
    }
</script>
@endpush
@endsection
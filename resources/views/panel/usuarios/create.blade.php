@extends('panel.layout')
@section('titulo', 'Nuevo usuario')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('indexUsuario') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a usuarios
    </a>
</div>

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-user-plus me-2"></i> Nuevo usuario</h5>
    </div>

    <form method="POST" action="{{ route('guardarUsuario') }}" enctype="multipart/form-data" style="padding: 28px;">
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
            {{-- Nombre y apellido --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="nombre">Nombre <span class="text-danger">*</span></label>
                <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required maxlength="255" placeholder="Ej: Juan">
                @error('nombre')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="apellido">Apellido <span class="text-danger">*</span></label>
                <input type="text" id="apellido" name="apellido" class="form-control-panel @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}" required maxlength="255" placeholder="Ej: Pérez">
                @error('apellido')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>

            {{-- CI, Celular, Email --}}
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="ci">Cédula de identidad <span class="text-danger">*</span></label>
                <input type="text" id="ci" name="ci" class="form-control-panel @error('ci') is-invalid @enderror" value="{{ old('ci') }}" required placeholder="12345678">
                @error('ci')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="celular">Celular <span class="text-danger">*</span></label>
                <input type="text" id="celular" name="celular" class="form-control-panel @error('celular') is-invalid @enderror" value="{{ old('celular') }}" required placeholder="76266570">
                @error('celular')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>
            <div class="col-md-4 form-group">
                <label class="form-label-panel" for="email">Email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control-panel @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="usuario@ejemplo.com">
                @error('email')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>

            {{-- Contraseña --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="password">Contraseña <span class="text-danger">*</span></label>
                <input type="password" id="password" name="password" class="form-control-panel @error('password') is-invalid @enderror" required placeholder="Mínimo 6 caracteres">
                @error('password')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>

            {{-- Ciudad y Rango --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="ciudad_id">Ciudad <span class="text-danger">*</span></label>
                <select id="ciudad_id" name="ciudad_id" class="form-control-panel @error('ciudad_id') is-invalid @enderror" required>
                    <option value="" disabled {{ old('ciudad_id') ? '' : 'selected' }}>-- Seleccionar ciudad --</option>
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}" {{ old('ciudad_id') == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
                @error('ciudad_id')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="rango_id">Rango / Rol</label>
                <select id="rango_id" name="rango_id" class="form-control-panel">
                    <option value="">-- Sin rango --</option>
                    @foreach($rangos as $rango)
                        <option value="{{ $rango->id }}" {{ old('rango_id') == $rango->id ? 'selected' : '' }}>{{ $rango->nombre ?? $rango->nombre_rango ?? 'Rango' }}</option>
                    @endforeach
                </select>
                @error('rango_id')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            {{-- Tipo de usuario --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="tipo">Tipo de usuario <span class="text-danger">*</span></label>
                <select id="tipo" name="tipo" class="form-control-panel @error('tipo') is-invalid @enderror" required>
                    <option value="" disabled {{ old('tipo') ? '' : 'selected' }}>-- Seleccionar --</option>
                    <option value="Usuario" {{ old('tipo') == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                    <option value="Administrador" {{ old('tipo') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="Empresa" {{ old('tipo') == 'Empresa' ? 'selected' : '' }}>Empresa</option>
                    <option value="Sadministrador" {{ old('tipo') == 'Sadministrador' ? 'selected' : '' }}>Superadministrador</option>
                </select>
                @error('tipo')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>

            {{-- Códigos (obligatorios) --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="codigo">Código de referido <span class="text-danger">*</span></label>
                <input type="text" id="codigo" name="codigo" class="form-control-panel @error('codigo') is-invalid @enderror" value="{{ old('codigo') }}" required placeholder="Código propio">
                @error('codigo')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="cod_face">Código FaceBol <span class="text-danger">*</span></label>
                <input type="text" id="cod_face" name="cod_face" class="form-control-panel @error('cod_face') is-invalid @enderror" value="{{ old('cod_face') }}" required placeholder="Código de tarjeta">
                @error('cod_face')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>

            {{-- Dirección, dinero y referido --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control-panel" value="{{ old('direccion') }}" placeholder="Calle, número, zona">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-label-panel" for="dinero">Saldo (Bs.)</label>
                <input type="number" step="0.01" id="dinero" name="dinero" class="form-control-panel" value="{{ old('dinero', 0) }}" placeholder="0.00">
            </div>
            <div class="col-md-12 form-group">
                <label class="form-label-panel" for="user_id">Referido por (usuario)</label>
                <select id="user_id" name="user_id" class="form-control-panel">
                    <option value="">-- Ninguno --</option>
                    @foreach($usuariosReferidos as $userRef)
                        <option value="{{ $userRef->id }}" {{ old('user_id') == $userRef->id ? 'selected' : '' }}>{{ $userRef->nombre }} {{ $userRef->apellido }} ({{ $userRef->email }})</option>
                    @endforeach
                </select>
                @error('user_id')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            {{-- Estado activo --}}
            <div class="col-md-6 form-group">
                <label class="form-label-panel">Cuenta activa</label>
                <div style="display:flex;align-items:center;gap:12px;margin-top:4px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="activo" value="1" {{ old('activo', true) ? 'checked' : '' }} style="accent-color:var(--primary);">
                        Usuario activo (puede iniciar sesión)
                    </label>
                </div>
            </div>

            {{-- Imagen  --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="imagen">Imagen de perfil <span class="text-danger">*</span></label>
                <input type="file" id="imagen" name="imagen" class="form-control-panel @error('imagen') is-invalid @enderror" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImagen(this, 'previewImg')" required>
                <small>Formatos: JPG, PNG, WEBP. Máx 2 MB.</small>
                <div id="previewImgWrapper" style="margin-top:10px; display:none;">
                    <img id="previewImg" src="" class="img-preview-large" style="max-width:150px; border-radius:50%;">
                </div>
                @error('imagen')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="d-flex gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-save"></i> Guardar usuario</button>
            <a href="{{ route('indexUsuario') }}" class="btn-accent-panel">Cancelar</a>
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
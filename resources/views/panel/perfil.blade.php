@extends('panel.layout')
@section('titulo', 'Mi perfil')

@section('content')

<div class="row g-4" style="max-width: 960px;">

    {{-- ── Tarjeta lateral: foto + resumen --}}
    <div class="col-lg-4">
        <div class="panel-card" style="position: sticky; top: 88px;">
            <div class="perfil-header">
                <div class="perfil-avatar-wrap">
                    <img id="avatar-preview"
                         src="{{ $user->imagen
                                ? asset('imagen/usuarios/' . $user->imagen)
                                : asset('imagen/institucion/avatar_default.png') }}"
                         alt="{{ $user->nombre_completo }}"
                         class="perfil-avatar">
                    <label for="imagen" class="perfil-avatar-edit" title="Cambiar foto">
                        <i class="fas fa-camera"></i>
                    </label>
                </div>
                <h5 class="perfil-name">{{ $user->nombre_completo }}</h5>
                <span class="perfil-tipo">{{ $user->tipo ?? 'Usuario' }}</span>
            </div>

            <div class="perfil-info-list">
                <div class="perfil-info-item">
                    <i class="fas fa-envelope"></i>
                    <span>{{ $user->email }}</span>
                </div>
                @if($user->celular)
                <div class="perfil-info-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>{{ $user->celular }}</span>
                </div>
                @endif
                @if($user->ciudad)
                <div class="perfil-info-item">
                    <i class="fas fa-city"></i>
                    <span>{{ $user->ciudad->nombre }}</span>
                </div>
                @endif
                @if($user->direccion)
                <div class="perfil-info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $user->direccion }}</span>
                </div>
                @endif
                @if($user->ci)
                <div class="perfil-info-item">
                    <i class="fas fa-id-card"></i>
                    <span>C.I. {{ $user->ci }}</span>
                </div>
                @endif
                @if($user->cod_face)
                <div class="perfil-info-item">
                    <i class="fas fa-id-badge"></i>
                    <span>Código FaceBol: {{ $user->cod_face }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ── Formulario de edición --}}
    <div class="col-lg-8">
        <div class="panel-card">
            <div class="panel-card-header">
                <h5><i class="fas fa-user-edit me-2"></i> Editar perfil</h5>
            </div>

            <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data" style="padding: 28px;">
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

                    <input type="file"
                        id="imagen"
                        name="imagen"
                        accept="image/jpg,image/jpeg,image/png,image/webp"
                        style="display: none;"
                        onchange="previewAvatar(this)">
                    @error('imagen')
                        <p class="field-error mb-3">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                        </p>
                    @enderror

                    <div class="row g-4">
                        {{-- Nombre y apellido --}}
                        <div class="col-md-6 form-group">
                            <label class="form-label-panel" for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre', $user->nombre) }}" placeholder="Ej.: Alan" required maxlength="100">
                            @error('nombre')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label-panel" for="apellido">Apellido <span class="text-danger">*</span></label>
                            <input type="text" id="apellido" name="apellido" class="form-control-panel @error('apellido') is-invalid @enderror" value="{{ old('apellido', $user->apellido) }}" placeholder="Ej.: Brito" required maxlength="100">
                            @error('apellido')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
                        </div>

                        {{-- CI y celular --}}
                        <div class="col-md-6 form-group">
                            <label class="form-label-panel" for="ci">Cédula de identidad <span class="text-danger">*</span></label>
                            <input type="text" id="ci" name="ci" class="form-control-panel @error('ci') is-invalid @enderror" value="{{ old('ci', $user->ci) }}" placeholder="Ej.: 123456789" required maxlength="20">
                            @error('ci')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label-panel" for="celular">Celular <span class="text-danger">*</span></label>
                            <input type="text" id="celular" name="celular" class="form-control-panel @error('celular') is-invalid @enderror" value="{{ old('celular', $user->celular) }}" placeholder="Ej.: 9876541" required maxlength="20">
                            @error('celular')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
                        </div>

                        {{-- Email y ciudad --}}
                        <div class="col-md-6 form-group">
                            <label class="form-label-panel" for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control-panel @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="Ej.: alanbrito@gmail.com" required>
                            @error('email')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label-panel" for="ciudad_id">Ciudad <span class="text-danger">*</span></label>
                            <select id="ciudad_id" name="ciudad_id" class="form-control-panel @error('ciudad_id') is-invalid @enderror" required>
                                <option value="" disabled>-- Seleccionar --</option>
                                @foreach($ciudades as $ciudad)
                                    <option value="{{ $ciudad->id }}" {{ old('ciudad_id', $user->ciudad_id) == $ciudad->id ? 'selected' : '' }}>{{ $ciudad->nombre }}</option>
                                @endforeach
                            </select>
                            @error('ciudad_id')<p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>@enderror
                        </div>

                        {{-- Dirección --}}
                        <div class="col-12 form-group">
                            <label class="form-label-panel" for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control-panel" value="{{ old('direccion', $user->direccion) }}" placeholder="Ej.: Zona Falsa, Av. Siempreviva Nº 742" maxlength="500">
                        </div>

                    </div>

                    <div class="d-flex gap-3 mt-4 pt-3 border-top">
                        <button type="submit" class="btn-primary-panel"><i class="fas fa-save"></i> Actualizar perfil</button>
                        <a href="{{ route('inicioPanel') }}" class="btn-accent-panel">Cancelar</a>
                    </div>
            </form>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
    /* ── Tarjeta de perfil lateral ── */
    .perfil-header {
        padding: 32px 24px 20px;
        text-align: center;
        border-bottom: 1px solid #f0f3f9;
    }

    .perfil-avatar-wrap {
        position: relative;
        display: inline-block;
        margin-bottom: 16px;
    }

    .perfil-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 4px 20px rgba(26, 58, 107, 0.18);
        display: block;
    }

    .perfil-avatar-edit {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--accent);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        transition: background 0.2s, transform 0.2s;
    }

    .perfil-avatar-edit:hover {
        background: var(--accent2);
        transform: scale(1.1);
    }

    .perfil-name {
        font-weight: 700;
        color: var(--primary);
        font-size: 1.05rem;
        margin-bottom: 4px;
    }

    .perfil-tipo {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: white;
        background: linear-gradient(135deg, var(--primary), var(--blue-light));
        padding: 3px 12px;
        border-radius: 100px;
    }

    /* ── Lista de info ── */
    .perfil-info-list {
        padding: 20px 24px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .perfil-info-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .perfil-info-item i {
        color: var(--blue-light);
        width: 16px;
        text-align: center;
        flex-shrink: 0;
        margin-top: 2px;
        font-size: 0.9rem;
    }

    .perfil-info-item span {
        word-break: break-word;
    }
</style>
@endpush

@push('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('avatar-preview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
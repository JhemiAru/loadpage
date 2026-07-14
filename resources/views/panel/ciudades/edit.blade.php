@extends('panel.layout')
@section('titulo', 'Editar ciudad')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('indexCiudad') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a ciudades
    </a>
</div>

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-edit me-2"></i> Editar ciudad: {{ $ciudad->nombre }}</h5>
    </div>

    <form method="POST" action="{{ route('actualizarCiudad', $ciudad) }}" style="padding: 28px;">
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
            <div class="col-12 form-group">
                <label class="form-label-panel" for="nombre">Nombre <span class="text-danger">*</span></label>
                <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre', $ciudad->nombre) }}" required maxlength="255" placeholder="Ej: La Paz, Santa Cruz, Cochabamba">
                @error('nombre')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- País --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="pais_id">País <span class="text-danger">*</span></label>
                <select id="pais_id" name="pais_id" class="form-control-panel @error('pais_id') is-invalid @enderror" required>
                    <option value="">-- Seleccionar país --</option>
                    @foreach($paises as $pais)
                        <option value="{{ $pais->id }}" {{ old('pais_id', $ciudad->pais_id) == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
                    @endforeach
                </select>
                @error('pais_id')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div class="col-12 form-group">
                <label class="form-label-panel" for="slug">Slug <span class="text-danger">*</span></label>
                <input type="text" id="slug" name="slug" class="form-control-panel @error('slug') is-invalid @enderror" value="{{ old('slug', $ciudad->slug) }}" required placeholder="Ej. el-alto, tarija">
                <small style="color: var(--text-muted);">Identificador único para URLs.</small>
                @error('slug')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="d-flex gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-sync-alt"></i> Actualizar ciudad</button>
            <a href="{{ route('indexCiudad') }}" class="btn-accent-panel">Cancelar</a>
        </div>
    </form>
</div>
@endsection
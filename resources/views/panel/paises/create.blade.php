@extends('panel.layout')
@section('titulo', 'Nuevo país')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('indexPais') }}" style="color: var(--blue-light); text-decoration:none; font-weight:600;">
        <i class="fas fa-arrow-left me-1"></i> Volver a países
    </a>
</div>

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-plus-circle me-2"></i> Nuevo país</h5>
    </div>

    <form method="POST" action="{{ route('guardarPais') }}" style="padding: 28px;">
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
            <div class="col-12 form-group">
                <label class="form-label-panel" for="nombre">Nombre <span class="text-danger">*</span></label>
                <input type="text" id="nombre" name="nombre" class="form-control-panel @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required maxlength="255" placeholder="Ej: Bolivia, Argentina, Brasil...">
                @error('nombre')
                    <p class="field-error"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="d-flex gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn-primary-panel"><i class="fas fa-save"></i> Guardar país</button>
            <a href="{{ route('indexPais') }}" class="btn-accent-panel">Cancelar</a>
        </div>
    </form>
</div>
@endsection
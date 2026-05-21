@extends('panel.layout')
@section('titulo', 'Actividades')

@section('content')

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-calendar-check me-2"></i> Actividades registradas</h5>
        <a href="{{ route('crearActividad') }}" class="btn-primary-panel">
            <i class="fas fa-plus"></i> Nueva actividad
        </a>
    </div>

    {{-- Buscador --}}
    <div class="p-3 border-bottom" style="background: #fafbfe;">
        <form method="GET" action="{{ route('indexActividad') }}" id="searchForm" autocomplete="off">
            <div class="search-wrap mb-2" style="position: relative; display: flex; gap: 8px;">
                <div style="flex: 1; position: relative;">
                    <input type="text"
                           name="search"
                           id="searchInput"
                           class="form-control-panel"
                           placeholder="Buscar por nombre, descripción o tipo..."
                           value="{{ request('search') }}"
                           style="padding-right: 40px;">
                    <button type="submit" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--blue-light);">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                @if(request('search'))
                    <a href="{{ route('indexActividad') }}" class="btn-accent-panel" style="display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fas fa-times"></i> Limpiar
                    </a>
                @endif
            </div>
        </form>
        @if(request('search'))
            <div class="mt-2 small text-muted">
                <i class="fas fa-filter me-1"></i> Mostrando resultados para: <strong>{{ request('search') }}</strong>
            </div>
        @endif
    </div>

    <div style="overflow-x: auto;">
        <table class="panel-table">
            <thead>
                <tr>
                    <th style="width:44px;">#</th>
                    <th style="width:60px;">Imagen</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th style="width:80px; text-align:center;">Activo</th>
                    <th style="width:115px; text-align:center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($actividades as $actividad)
                <tr>
                    <td style="color:var(--text-muted);font-size:0.8rem;">{{ $actividad->id }}</td>

                    {{-- Imagen --}}
                    <td>
                        @if($actividad->imagen)
                            <img src="{{ asset('imagen/actividades/' . $actividad->imagen) }}"
                                 alt="{{ $actividad->nombre }}"
                                 class="img-preview">
                        @else
                            <div style="width:48px;height:48px;border-radius:10px;background:#f0f3f9;
                                        display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-image" style="color:#bbc3d4;"></i>
                            </div>
                        @endif
                    </td>

                    {{-- Nombre + descripción --}}
                    <td>
                        <span style="font-weight:600;">{{ Str::limit($actividad->nombre, 70) }}</span>
                        @if($actividad->descripcion)
                            <br><small style="color:var(--text-muted);">
                                {{ Str::limit($actividad->descripcion, 60) }}
                            </small>
                        @endif
                    </td>

                    {{-- Tipo --}}
                    <td>
                        @if($actividad->tipo)
                            <span class="badge-panel badge-fecha">{{ $actividad->tipo }}</span>
                        @else
                            <span style="color:#ccd3e0;">—</span>
                        @endif
                    </td>

                    {{-- Fecha --}}
                    <td>
                        <span class="badge-panel" style="background:rgba(46,107,196,0.08);color:var(--primary);">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $actividad->fecha->format('d/m/Y') }}
                        </span>
                    </td>

                    {{-- Toggle activo --}}
                    <td style="text-align:center;">
                        <form method="POST" action="{{ route('toggleActivoActividad', $actividad->id) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    title="{{ $actividad->activo ? 'Desactivar' : 'Activar' }}"
                                    style="background:none;border:none;cursor:pointer;font-size:1.25rem;padding:0;">
                                @if($actividad->activo)
                                    <i class="fas fa-toggle-on" style="color:#16a34a;"></i>
                                @else
                                    <i class="fas fa-toggle-off" style="color:#d1d5db;"></i>
                                @endif
                            </button>
                        </form>
                    </td>

                    {{-- Acciones --}}
                    <td>
                        <div style="display:flex;gap:6px;justify-content:center;">
                            <a href="{{ route('editarActividad', $actividad->id) }}"
                               class="btn-accent-panel" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="POST"
                                  action="{{ route('eliminarActividad', $actividad->id) }}"
                                  onsubmit="return confirm('¿Eliminar «{{ addslashes($actividad->nombre) }}»?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger-panel" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:44px;color:var(--text-muted);">
                        <i class="fas fa-calendar-times"
                           style="font-size:2rem;display:block;margin-bottom:10px;color:#ccd3e0;"></i>
                        No hay actividades registradas.
                        <a href="{{ route('crearActividad') }}"
                           style="color:var(--blue-light);font-weight:600;margin-left:4px;">
                            Crear la primera
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($actividades->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $actividades->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
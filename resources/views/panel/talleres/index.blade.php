@extends('panel.layout')
@section('titulo', 'Talleres')

@section('content')

<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-chalkboard-teacher me-2"></i> Talleres registrados</h5>
        <a href="{{ route('crearTaller') }}" class="btn-primary-panel">
            <i class="fas fa-plus"></i> Nuevo taller
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="panel-table">
            <thead>
                <tr>
                    <th style="width:56px;">#</th>
                    <th style="width:60px;">Imagen</th>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Lugar</th>
                    <th>Costo</th>
                    <th style="width:130px; text-align:center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($talleres as $taller)
                <tr>
                    <td style="color: var(--text-muted); font-size: 0.8rem;">{{ $taller->id }}</td>
                    <td>
                        @if($taller->imagen)
                            <img src="{{ Storage::url($taller->imagen) }}"
                                 alt="{{ $taller->titulo }}"
                                 class="img-preview">
                        @else
                            <div style="width:52px;height:52px;border-radius:10px;background:#f0f3f9;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-image" style="color:#bbc3d4;"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <span style="font-weight: 600;">{{ $taller->titulo }}</span>
                        @if($taller->descripcion)
                            <br><small style="color: var(--text-muted);">{{ Str::limit($taller->descripcion, 55) }}</small>
                        @endif
                    </td>
                    <td>
                        <span class="badge-panel badge-fecha">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($taller->fecha)->format('d-m-Y') }}
                        </span>
                    </td>
                    <td style="font-size: 0.85rem;">{{ $taller->horario }}</td>
                    <td style="font-size: 0.85rem; max-width: 160px;">{{ Str::limit($taller->lugar, 40) }}</td>
                    <td>
                        <span class="badge-panel badge-costo">
                            Bs. {{ number_format($taller->costo, 2) }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; justify-content:center;">
                            <a href="{{ route('indexTaller', $taller) }}" class="btn-accent-panel">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="POST"
                                  action="{{ route('indexTaller', $taller) }}"
                                  onsubmit="return confirm('¿Eliminar el taller «{{ addslashes($taller->titulo) }}»? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-panel">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding: 40px; color: var(--text-muted);">
                        <i class="fas fa-inbox" style="font-size:2rem; display:block; margin-bottom:8px; color:#ccd3e0;"></i>
                        No hay talleres registrados aún.
                        <a href="{{ route('crearTaller') }}" style="color: var(--blue-light); font-weight:600; margin-left:4px;">Crear el primero</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($talleres->hasPages())
        <div style="padding: 16px 24px; border-top: 1px solid #f0f3f9;">
            {{ $talleres->links() }}
        </div>
    @endif
</div>

@endsection

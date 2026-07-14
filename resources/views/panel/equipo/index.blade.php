@extends('panel.layout')
@section('titulo', 'Equipo')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-users me-2"></i> Miembros del equipo</h5>
        <a href="{{ route('crearEquipo') }}" class="btn-primary-panel">
            <i class="fas fa-plus"></i> Nuevo miembro
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="panel-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Redes</th>
                    <th>Estado</th>
                    <th style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipo as $miembro)
                <tr>
                    <td>{{ $miembro->id }}</td>
                    <td>
                        @if($miembro->imagen)
                            <img src="{{ asset('imagen/equipos/' . $miembro->imagen) }}" class="img-preview" style="width:50px; height:50px; object-fit:cover;">
                        @else
                            <div class="img-placeholder">—</div>
                        @endif
                    </td>
                    <td><strong>{{ $miembro->nombre }}</strong></td>
                    <td>{{ $miembro->cargo }}</td>
                    <td>
                        @if($miembro->facebook && $miembro->facebook != 'sdf')
                            <a href="{{ $miembro->facebook }}" target="_blank" class="text-primary me-2"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($miembro->twitter)
                            <a href="{{ $miembro->twitter }}" target="_blank" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($miembro->instagram)
                            <a href="{{ $miembro->instagram }}" target="_blank" class="text-primary"><i class="fab fa-instagram"></i></a>
                        @endif
                     </td>
                    <td style="text-align:center;">
                        <form method="POST" action="{{ route('toggleEstadoEquipo', $miembro) }}">
                            @csrf @method('PATCH')
                            <button type="submit" title="Cambiar estado" class="btn-toggle" style="background:none; border:none; cursor:pointer;">
                                @if($miembro->estado)
                                    <i class="fas fa-toggle-on" style="color:#16a34a; font-size:1.3rem;"></i>
                                @else
                                    <i class="fas fa-toggle-off" style="color:#d1d5db; font-size:1.3rem;"></i>
                                @endif
                            </button>
                        </form>
                     </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('editarEquipo', $miembro) }}" class="btn-accent-panel" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="POST" action="{{ route('eliminarEquipo', $miembro) }}" onsubmit="return confirm('¿Eliminar este miembro del equipo?')">
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
                    <td colspan="7" class="text-center py-4">
                        No hay miembros registrados.
                        <a href="{{ route('crearEquipo') }}" style="color: var(--blue-light);">Agregar el primero</a>
                    </td>
                 </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('panel.layout')
@section('titulo', 'Países')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-globe-americas me-2"></i> Países registrados</h5>
        <a href="{{ route('crearPais') }}" class="btn-primary-panel">
            <i class="fas fa-plus"></i> Nuevo país
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="panel-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ciudades</th>
                    <th style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($paises as $pais)
                <tr>
                    <td>{{ $pais->id }}</td>
                    <td><strong>{{ $pais->nombre }}</strong></td>
                    <td>
                        <span class="badge-panel badge-costo">
                            {{ $pais->ciudades()->count() }} {{ $pais->ciudades()->count() == 1 ? 'ciudad' : 'ciudades' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('editarPais', $pais) }}" class="btn-accent-panel" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="POST" action="{{ route('eliminarPais', $pais) }}" onsubmit="return confirm('¿Desea eliminar el país «{{ $pais->nombre }}»?')">
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
                    <td colspan="3" class="text-center py-4">
                        No hay países registrados.
                        <a href="{{ route('crearPais') }}" style="color: var(--blue-light);">Crear el primero</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
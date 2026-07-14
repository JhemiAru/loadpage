@extends('panel.layout')
@section('titulo', 'Ciudades')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-city me-2"></i> Ciudades registradas</h5>
        <a href="{{ route('crearCiudad') }}" class="btn-primary-panel">
            <i class="fas fa-plus"></i> Nueva ciudad
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="panel-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>Slug</th>
                    <th>Empresas</th>
                    <th style="width: 100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ciudades as $ciudad)
                <tr>
                    <td>{{ $ciudad->id }}</td>
                    <td><strong>{{ $ciudad->nombre }}</strong></td>
                    <td>{{ $ciudad->pais->nombre ?? '—' }}</td>
                    <td><code>{{ $ciudad->slug }}</code></td>
                    <td>
                        <span class="badge-panel badge-costo">
                            {{ $ciudad->empresas()->count() }} {{ $ciudad->empresas()->count() == 1 ? 'empresa' : 'empresas' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('editarCiudad', $ciudad) }}" class="btn-accent-panel" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="POST" action="{{ route('eliminarCiudad', $ciudad) }}" onsubmit="return confirm('¿Esta seguro que desea eliminar la ciudad «{{ $ciudad->nombre }}»?')">
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
                    <td colspan="5" class="text-center py-4">
                        No hay ciudades registradas.<a href="{{ route('crearCiudad') }}" style="color: var(--blue-light);">Crear la primera</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
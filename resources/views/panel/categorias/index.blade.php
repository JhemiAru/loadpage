@extends('panel.layout')
@section('titulo', 'Categorías')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-tags me-2"></i> Listado de categorías</h5>
        <a href="{{ route('crearCategoria') }}" class="btn-primary-panel">
            <i class="fas fa-plus"></i> Nueva categoría
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="panel-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Icono</th>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Empresas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>
                        @if($categoria->icono)
                            <i class="{{ $categoria->icono }}" style="font-size: 1.5rem; color: var(--primary);"></i>
                        @else
                            <i class="fas fa-tag" style="font-size: 1.5rem; color: #cbd5e1;"></i>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $categoria->nombre }}</strong>
                        @if($categoria->descripcion)
                            <br><small class="text-muted">{{ Str::limit($categoria->descripcion, 60) }}</small>
                        @endif
                    </td>
                    <td><code>{{ $categoria->slug }}</code></td>
                    <td>
                        <span class="badge-panel badge-costo">
                            {{ $categoria->empresas()->count() }} {{ $categoria->empresas()->count() == 1 ? 'empresa' : 'empresas' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('editarCategoria', $categoria) }}" class="btn-accent-panel" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="POST" action="{{ route('eliminarCategoria', $categoria) }}" 
                                  onsubmit="return confirm('¿Eliminar la categoría «{{ $categoria->nombre }}»?')">
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
                    <td colspan="6" class="text-center py-4">
                        No hay categorías registradas.<a href="{{ route('crearCategoria') }}" style="color: var(--blue-light);">Crear la primera</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('panel.layout')
@section('titulo', 'Usuarios')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-users me-2"></i> Usuarios registrados</h5>
        <a href="{{ route('crearUsuario') }}" class="btn-primary-panel">
            <i class="fas fa-plus"></i> Nuevo usuario
        </a>
    </div>

    {{-- Filtros y búsqueda --}}
    <div class="p-3 border-bottom" style="background: #fafbfe;">
        <form method="GET" action="{{ route('indexUsuario') }}" autocomplete="off">
            <div class="row g-2 align-items-end">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control-panel" placeholder="Buscar por nombre, email, CI, celular..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="tipo" class="form-control-panel">
                        <option value="">Todos los tipos</option>
                        <option value="admin" {{ request('tipo')=='admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="user" {{ request('tipo')=='user' ? 'selected' : '' }}>Usuario normal</option>
                        <option value="empresa" {{ request('tipo')=='empresa' ? 'selected' : '' }}>Empresa</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="activo" class="form-control-panel">
                        <option value="">Todos</option>
                        <option value="1" {{ request('activo')=='1' ? 'selected' : '' }}>Activos</option>
                        <option value="0" {{ request('activo')=='0' ? 'selected' : '' }}>Inactivos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-primary-panel w-100"><i class="fas fa-search"></i> Filtrar</button>
                        @if(request('search') || request('tipo') || request('activo'))
                            <a href="{{ route('indexUsuario') }}" class="btn-accent-panel">Limpiar</a>
                        @endif
                    </div>
                </div>
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
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre completo</th>
                    <th>Email</th>
                    <th>CI</th>
                    <th>Celular</th>
                    <th>Tipo</th>
                    <th>Rango</th>
                    <th>Estado</th>
                    <th style="width:100px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td class="text-center">
                        @if($usuario->imagen)
                            <img src="{{ asset('imagen/usuarios/' . $usuario->imagen) }}" class="img-preview" style="width:45px; height:45px; object-fit:cover; border-radius:50%;">
                        @else
                            <div style="width:45px;height:45px;background:#f0f3f9;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-user" style="color:#bbc3d4;"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $usuario->nombre_completo }}</strong><br><small class="text-muted">{{ $usuario->ciudad->nombre ?? 'Sin ciudad' }}</small></td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->ci ?? '-' }}</td>
                    <td>{{ $usuario->celular ?? '-' }}</td>
                    <td>
                        <span class="badge-panel" style="background: {{ $usuario->tipo == 'admin' ? '#fef3c7' : ($usuario->tipo == 'empresa' ? '#dbeafe' : '#e0f2fe') }};">
                            {{ ucfirst($usuario->tipo) }}
                        </span>
                    </td>
                    <td>{{ $usuario->rango->nombre ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('toggleActivoUsuario', $usuario) }}">
                            @csrf @method('PATCH')
                            <button type="submit" title="Cambiar estado" style="background:none;border:none;cursor:pointer;">
                                @if($usuario->activo)
                                    <i class="fas fa-toggle-on" style="color:#16a34a; font-size:1.3rem;"></i>
                                @else
                                    <i class="fas fa-toggle-off" style="color:#d1d5db; font-size:1.3rem;"></i>
                                @endif
                            </button>
                        </form>
                     </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('editarUsuario', $usuario) }}" class="btn-accent-panel" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                            <form method="POST" action="{{ route('eliminarUsuario', $usuario) }}" onsubmit="return confirm('¿Eliminar este usuario? Se perderán sus datos.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger-panel" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                     </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-4">No hay usuarios registrados. <a href="{{ route('crearUsuario') }}" style="color:var(--blue-light);">Crear el primero</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($usuarios->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $usuarios->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
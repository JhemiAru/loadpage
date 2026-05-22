@extends('panel.layout')
@section('titulo', 'Empresas')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-store me-2"></i> Empresas registradas</h5>
        <a href="{{ route('crearEmpresa') }}" class="btn-primary-panel">
            <i class="fas fa-plus"></i> Nueva empresa
        </a>
    </div>

    {{-- Buscador y filtros --}}
    <div class="p-3 border-bottom" style="background: #fafbfe;">
        <form method="GET" action="{{ route('indexEmpresa') }}" id="filterForm" autocomplete="off">
            <div class="search-wrap mb-3" style="position: relative; display: flex; gap: 8px;">
                <div style="flex: 1; display: flex; gap: 8px;">
                    <input type="text"
                        name="search"
                        id="searchInput"
                        class="form-control-panel"
                        placeholder="Buscar por nombre, categoría, ciudad o teléfono..."
                        value="{{ request('search') }}"
                        style="flex: 1;">
                    
                    <button type="submit" class="btn-primary-panel" style="display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
                @if(request('search') || request('categoria_id') || request('ciudad_id') || request('activo') !== null || request('aliadas') !== null || request('destacado') !== null || request('sort_field') || request('sort_dir'))
                    <a href="{{ route('indexEmpresa') }}" class="btn-accent-panel" style="display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                        <i class="fas fa-times"></i> Limpiar filtros
                    </a>
                @endif
            </div>

            <div class="row g-2 mb-2">
                <div class="col-md-3">
                    <select name="categoria_id" class="form-control-panel">
                        <option value="">-- Categoría --</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="ciudad_id" class="form-control-panel">
                        <option value="">-- Ciudad --</option>
                        @foreach($ciudades as $ciudad)
                            <option value="{{ $ciudad->id }}" {{ request('ciudad_id') == $ciudad->id ? 'selected' : '' }}>
                                {{ $ciudad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="activo" class="form-control-panel">
                        <option value="">-- Estado --</option>
                        <option value="1" {{ request('activo') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ request('activo') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="aliadas" class="form-control-panel">
                        <option value="">-- Aliada --</option>
                        <option value="1" {{ request('aliadas') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ request('aliadas') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="destacado" class="form-control-panel">
                        <option value="">-- Destacado --</option>
                        <option value="1" {{ request('destacado') == '1' ? 'selected' : '' }}>Destacado</option>
                        <option value="0" {{ request('destacado') == '0' ? 'selected' : '' }}>No destacado</option>
                    </select>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-md-4">
                    <select name="sort_field" class="form-control-panel">
                        <option value="prioridad" {{ request('sort_field', 'prioridad') == 'prioridad' ? 'selected' : '' }}>Ordenar por Prioridad</option>
                        <option value="nombre" {{ request('sort_field') == 'nombre' ? 'selected' : '' }}>Ordenar por Nombre</option>
                        <option value="created_at" {{ request('sort_field') == 'created_at' ? 'selected' : '' }}>Ordenar por Fecha creación</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="sort_dir" class="form-control-panel">
                        <option value="asc" {{ request('sort_dir', 'asc') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                        <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>Descendente</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn-primary-panel w-100">Aplicar filtros</button>
                </div>
            </div>
        </form>

        @if(request('search') || request('categoria_id') || request('ciudad_id') || request('activo') !== null || request('aliadas') !== null || request('destacado') !== null)
            <div class="mt-2 small text-muted">
                <i class="fas fa-filter me-1"></i> 
                Filtros activos:
                @if(request('search')) <span class="badge bg-secondary">Búsqueda: "{{ request('search') }}"</span> @endif
                @if(request('categoria_id')) <span class="badge bg-secondary">Categoría: {{ $categorias->firstWhere('id', request('categoria_id'))?->nombre ?? '?' }}</span> @endif
                @if(request('ciudad_id')) <span class="badge bg-secondary">Ciudad: {{ $ciudades->firstWhere('id', request('ciudad_id'))?->nombre ?? '?' }}</span> @endif
                @if(request('activo') !== null) <span class="badge bg-secondary">Estado: {{ request('activo') == '1' ? 'Activo' : 'Inactivo' }}</span> @endif
                @if(request('aliadas') !== null) <span class="badge bg-secondary">Aliada: {{ request('aliadas') == '1' ? 'Sí' : 'No' }}</span> @endif
                @if(request('destacado') !== null) <span class="badge bg-secondary">Destacado: {{ request('destacado') == '1' ? 'Sí' : 'No' }}</span> @endif
            </div>
        @endif
    </div>

    <div class="p-3 border-bottom d-flex justify-content-between align-items-center" style="background: #fafbfe;">
        <div>
            <i class="fas fa-table-list me-1"></i>
            <strong>{{ $empresas->total() }}</strong> 
            {{ $empresas->total() == 1 ? 'empresa encontrada' : 'empresas encontradas' }}
        </div>
        <div>
            Mostrando {{ $empresas->firstItem() ?? 0 }} - {{ $empresas->lastItem() ?? 0 }} de {{ $empresas->total() }}
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="panel-table">
            <thead>
                <tr>
                    <th style="width:44px;">#</th>
                    <th style="width:56px;">Img</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Ciudad</th>
                    <th>Descuento</th>
                    <th style="width:60px; text-align:center;">Activo</th>
                    <th style="width:60px; text-align:center;">Dest.</th>
                    <th style="width:60px; text-align:center;">Aliada</th>
                    <th style="width:115px; text-align:center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($empresas as $empresa)
                <tr>
                    <td style="color:var(--text-muted);font-size:0.8rem;">{{ $empresa->id }}</td>
                    <td>
                        @if($empresa->imagen)
                            <img src="{{ asset('imagen/empresas/' . $empresa->imagen) }}"
                                 alt="{{ Str::limit($empresa->nombre, 5) }}"
                                 class="img-preview">
                        @else
                            <div style="width:48px;height:48px;border-radius:10px;background:#f0f3f9;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-image" style="color:#bbc3d4;"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <span style="font-weight:600;">{{ Str::limit($empresa->nombre, 100) }}</span>
                        @if($empresa->telefono)
                            <br><small style="color:var(--text-muted);">
                                <i class="fas fa-phone-alt me-1"></i>{{ $empresa->telefono }}
                            </small>
                        @endif
                    </td>
                    <td style="font-size:0.85rem;">
                        {{ optional($empresa->categoria)->nombre ?? '—' }}
                    </td>
                    <td style="font-size:0.85rem;">
                        {{ optional($empresa->ciudad)->nombre ?? '—' }}
                    </td>
                    <td>
                        @if($empresa->descuento)
                            <span class="badge-panel badge-costo text-nowrap">{{ Str::limit($empresa->descuento, 20) }}</span>
                        @else
                            <span style="color:#ccd3e0;">—</span>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        <form method="POST" action="{{ route('toggleActivoEmpresa', $empresa->id) }}">
                            @csrf @method('PATCH')
                            <button type="submit" title="{{ $empresa->activo ? 'Desactivar' : 'Activar' }}"
                                style="background:none;border:none;cursor:pointer;font-size:1.2rem;padding:0;">
                                @if($empresa->activo)
                                    <i class="fas fa-toggle-on" style="color:#16a34a;"></i>
                                @else
                                    <i class="fas fa-toggle-off" style="color:#d1d5db;"></i>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td style="text-align:center;">
                        <form method="POST" action="{{ route('toggleDestacadoEmpresa', $empresa->id) }}">
                            @csrf @method('PATCH')
                            <button type="submit" title="{{ $empresa->destacado ? 'Quitar destacado' : 'Destacar' }}"
                                style="background:none;border:none;cursor:pointer;font-size:1.1rem;padding:0;">
                                <i class="fas fa-star" style="color:{{ $empresa->destacado ? 'var(--accent)' : '#d1d5db' }};"></i>
                            </button>
                        </form>
                    </td>
                    <td style="text-align:center;">
                        <form method="POST" action="{{ route('toggleAliadasEmpresa', $empresa->id) }}">
                            @csrf @method('PATCH')
                            <button type="submit" title="{{ $empresa->aliadas ? 'Quitar aliada' : 'Marcar aliada' }}"
                                style="background:none;border:none;cursor:pointer;font-size:1.1rem;padding:0;">
                                <i class="fas fa-handshake" style="color:{{ $empresa->aliadas ? 'var(--blue-light)' : '#d1d5db' }};"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;justify-content:center;">
                            <a href="{{ route('editarEmpresa', $empresa->id) }}" class="btn-accent-panel" title="Editar">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form method="POST"
                                  action="{{ route('eliminarEmpresa', $empresa->id) }}"
                                  onsubmit="return confirm('¿Eliminar «{{ addslashes($empresa->nombre) }}»?')">
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
                    <td colspan="10" style="text-align:center;padding:40px;color:var(--text-muted);">
                        <i class="fas fa-store-slash" style="font-size:2rem;display:block;margin-bottom:8px;color:#ccd3e0;"></i>
                        No hay empresas registradas.
                        @if(request('search') || request('categoria_id') || request('ciudad_id') || request('activo') !== null)
                            <br>No se encontraron resultados con los filtros actuales.
                            <br><a href="{{ route('indexEmpresa') }}" style="color:var(--blue-light);">Limpiar filtros</a>
                        @else
                            <a href="{{ route('crearEmpresa') }}" style="color:var(--blue-light);font-weight:600;margin-left:4px;">
                                Crear la primera
                            </a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($empresas->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $empresas->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
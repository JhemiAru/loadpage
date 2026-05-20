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

    {{-- Buscador --}}
    <div class="p-3 border-bottom" style="background: #fafbfe;">
        <form method="GET" action="{{ route('indexEmpresa') }}" id="searchForm" autocomplete="off">
            <div class="search-wrap mb-2" style="position: relative; display: flex; gap: 8px;">
                <div style="flex: 1; position: relative;">
                    <input type="text"
                           name="search"
                           id="searchInput"
                           class="form-control-panel"
                           placeholder="Buscar por nombre, categoría, ciudad o teléfono..."
                           value="{{ request('search') }}"
                           style="padding-right: 40px;">
                    <button type="submit" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--blue-light);">
                        <i class="fas fa-search"></i>
                    </button>
                    <div id="suggestions" style="position: absolute; top: 100%; left: 0; right: 0; background: white; border-radius: 10px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); z-index: 1000; display: none; max-height: 300px; overflow-y: auto;"></div>
                </div>
                @if(request('search'))
                    <a href="{{ route('indexEmpresa') }}" class="btn-accent-panel" style="display: inline-flex; align-items: center; gap: 6px;">
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
                                  onsubmit="return confirm('¿Eliminar «{{ addslashes($empresa->nombre) }}»? Esta acción no se puede deshacer.')">
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
                        @if(request('search'))
                            <br>No se encontraron resultados para "<strong>{{ request('search') }}</strong>".
                            <br><a href="{{ route('indexEmpresa') }}" style="color:var(--blue-light);">Limpiar búsqueda</a>
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
@extends('panel.layout')
@section('titulo', 'Galería de imágenes')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h5><i class="fas fa-images me-2"></i> Todas las imágenes del sistema</h5>
    </div>

    {{-- Filtros y búsqueda --}}
    <div class="p-3 border-bottom" style="background: #fafbfe;">
        <form method="GET" action="{{ route('indexGaleria') }}" id="filterForm">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label-panel">Buscar por nombre</label>
                    <input type="text" name="search" class="form-control-panel" value="{{ request('search') }}" placeholder="Ej: taller, empresa, banner...">
                </div>
                <div class="col-md-2">
                    <label class="form-label-panel">Sección</label>
                    <select name="modelo" class="form-control-panel" onchange="this.form.submit()">
                        <option value="">-- Todos --</option>
                        @foreach($modelos as $m)
                            <option value="{{ $m }}" {{ request('modelo') == $m ? 'selected' : '' }}>{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label-panel">Ordenar por</label>
                    <select name="sort" class="form-control-panel" onchange="this.form.submit()">
                        <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>Fecha creación</option>
                        <option value="titulo" {{ request('sort') == 'titulo' ? 'selected' : '' }}>Nombre (título)</option>
                        <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>ID</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label-panel">Orden</label>
                    <select name="direction" class="form-control-panel" onchange="this.form.submit()">
                        <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>Descendente</option>
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-primary-panel w-100">Filtrar</button>
                </div>
            </div>
            @if(request('search') || request('modelo'))
                <div class="mt-2">
                    <a href="{{ route('indexGaleria') }}" class="btn-accent-panel btn-sm">Limpiar filtros</a>
                </div>
            @endif
        </form>
    </div>

    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
        <div><i class="fa-regular fa-images"></i> <strong>{{ $paginador->total() }}</strong> imágenes encontradas</div>
        <div>Mostrando {{ $paginador->firstItem() ?? 0 }} - {{ $paginador->lastItem() ?? 0 }}</div>
    </div>

    <div class="p-3">
        <div class="row g-4">
            @forelse($paginador as $img)
                @php
                    $fileExists = Storage::disk($img->ruta_disco)->exists($img->nombre_archivo);
                @endphp

                <div class="col-md-3 col-sm-6">
                    <div class="card h-100 shadow-sm d-flex flex-column">

                        <div style="height: 180px; overflow: hidden; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                            @if($fileExists)
                                <img src="{{ $img->url }}" class="img-fluid" alt="{{ $img->nombre_archivo }}" style="object-fit: cover; width: 100%; height: 100%;">
                            @else
                                <div class="text-center">
                                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                                    <p class="small mt-2 mb-0">Archivo no encontrado</p>
                                </div>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <h6 class="card-title mb-1">{{ $img->titulo }}</h6>
                            <p style="font-size: 0.8rem; color: #555; margin-bottom: 12px; line-height: 1.7;">
                                <span style="color: var(--primary); font-weight: 700;">Archivo:</span>
                                {{ Str::limit($img->nombre_archivo, 25) }}<br>
                                <span style="color: var(--primary); font-weight: 700;">Sección:</span>
                                @if($img->campo !== 'imagen1')
                                    {{ $img->modelo }}<br>
                                @else
                                    Empresa Adicional<br>
                                @endif
                                <span style="color: var(--primary); font-weight: 700;">Fecha:</span>
                                {{ $img->created_at ? \Carbon\Carbon::parse($img->created_at)->format('d/m/Y') : 'N/A' }}
                            </p>

                            @if($fileExists)
                                <form method="POST" action="{{ route('editarGaleria') }}" class="mb-3" onsubmit="return confirm('¿Renombrar este archivo?')">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="modelo" value="{{ strtolower($img->modelo) }}">
                                    <input type="hidden" name="id" value="{{ $img->id }}">
                                    <input type="hidden" name="campo" value="{{ $img->campo }}">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                        <input type="text" name="nombre" class="form-control" value="{{ $img->nombre_archivo }}" required placeholder="Nombre del archivo">
                                        <button class="btn btn-outline-primary bg-white font-weight-bold" type="submit" style="color:var(--primary)">OK</button>
                                    </div>
                                </form>
                            @endif                            

                            <div>
                                <form method="POST" action="{{ route('actualizarGaleria') }}" enctype="multipart/form-data" id="uploadForm-{{ $img->id }}">
                                    @csrf
                                    <input type="hidden" name="modelo" value="{{ strtolower($img->modelo) }}">
                                    <input type="hidden" name="id" value="{{ $img->id }}">
                                    <input type="hidden" name="campo" value="{{ $img->campo }}">
                                    
                                    <div class="mb-2">
                                        <input type="file" name="imagen" class="form-control form-control-sm" accept="image/jpg,image/jpeg,image/png,image/webp" required>
                                    </div>
                                </form>

                                <div class="d-flex gap-2">
                                    <button type="submit" form="uploadForm-{{ $img->id }}" class="btn-primary-panel flex-grow-1 d-inline-flex align-items-center justify-content-center">
                                        <i class="fas fa-upload"></i> Subir
                                    </button>

                                    <form method="POST" action="{{ route('eliminarGaleria') }}" onsubmit="return confirm('¿Eliminar permanentemente esta imagen?')" class="flex-grow-1">
                                        @csrf @method('DELETE')
                                        <input type="hidden" name="modelo" value="{{ strtolower($img->modelo) }}">
                                        <input type="hidden" name="id" value="{{ $img->id }}">
                                        <input type="hidden" name="campo" value="{{ $img->campo }}">
                                        <button type="submit" class="btn-accent-panel w-100 d-inline-flex align-items-center justify-content-center gap-1">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <p>No hay imágenes que coincidan con los filtros.</p>
                </div>
            @endforelse
        </div>
    </div>

    @if($paginador->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $paginador->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="margin: 0 auto; max-width: 95vw; width: auto; display: flex; align-items: center;">
        <div class="modal-content" style="background: transparent; border: none; box-shadow: none; width: auto; margin: 0 auto;">
            <div class="modal-body text-center p-0">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" style="z-index: 1050; background-color: rgba(0,0,0,0.5); border-radius: 50%; padding: 8px;" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                <img id="modalImage" src="" alt="Imagen ampliada" style="max-width: 90vw; max-height: 85vh; width: auto; height: auto; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,0.3);">
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.querySelectorAll('.card img').forEach(img => {
        img.addEventListener('click', function(e) {
            e.preventDefault();
            const modalImg = document.getElementById('modalImage');
            modalImg.src = this.src;
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        });
    });
</script>
@endpush
@endsection
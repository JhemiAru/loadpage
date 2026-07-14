<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Actividad;
use App\Models\Empresa;
use App\Models\Equipo;
use App\Models\Taller;
use App\Models\User;
use App\Models\Institucion;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class controllerGaleria extends Controller
{
    public function index(Request $request)
    {
        $query = collect();

        $search = $request->get('search');
        $sort = $request->get('sort', 'created_at'); 
        $direction = $request->get('direction', 'desc');
        $modeloFilter = $request->get('modelo'); 

        $collectImages = function($modeloClass, $modeloNombre, $campoImagen, $disco, $tituloCampo, $fechaCampo = 'created_at') use ($search, $modeloFilter) {
            if ($modeloFilter && $modeloFilter !== $modeloNombre) return collect();

            $queryModel = $modeloClass::whereNotNull($campoImagen);

            if ($search) {
                $queryModel->where($tituloCampo, 'LIKE', "%{$search}%");
            }
            
            $items = $queryModel->get();
            
            return $items->map(function($item) use ($modeloNombre, $campoImagen, $disco, $tituloCampo, $fechaCampo) {
                return (object)[
                    'id'        => $item->id,
                    'modelo'    => $modeloNombre,
                    'tabla'     => $item->getTable(),
                    'campo'     => $campoImagen,
                    'nombre_archivo' => $item->$campoImagen,
                    'titulo'    => $item->$tituloCampo,
                    'created_at'=> $item->$fechaCampo,
                    'url'       => $this->getUrl($disco, $item->$campoImagen),
                    'ruta_disco'=> $disco,
                    'ruta_eliminar' => route('eliminarGaleria', ['modelo' => strtolower($modeloNombre), 'id' => $item->id, 'campo' => $campoImagen])
                ];
            });
        };

        $imagenes = collect();
        $imagenes = $imagenes->concat($collectImages(Actividad::class, 'Actividad', 'imagen', 'actividades', 'nombre'));
        $imagenes = $imagenes->concat($collectImages(Empresa::class, 'Empresa', 'imagen', 'empresas', 'nombre'));
        $imagenes = $imagenes->concat($collectImages(Empresa::class, 'Empresa', 'imagen1', 'empresasproductos', 'nombre'));
        $imagenes = $imagenes->concat($collectImages(Equipo::class, 'Equipo', 'imagen', 'equipos', 'nombre'));
        $imagenes = $imagenes->concat($collectImages(Taller::class, 'Taller', 'imagen', 'talleres', 'titulo'));
        $imagenes = $imagenes->concat($collectImages(User::class, 'Usuario', 'imagen', 'usuarios', 'nombre'));
        $imagenes = $imagenes->concat($collectImages(Categoria::class, 'Categoria', 'imagen', 'categorias', 'nombre'));
        
        $institucion = Institucion::first();
        if ($institucion && (!$modeloFilter || $modeloFilter === 'Institucion')) {
            $campos = ['imagen', 'banner1', 'banner2', 'banner3', 'imgtrabaja'];
            foreach ($campos as $campo) {
                if (!empty($institucion->$campo)) {
                    if (!$search || stripos($campo, $search) !== false) { // Búsqueda simple por nombre del campo
                        $imagenes->push((object)[
                            'id'        => $institucion->id,
                            'modelo'    => 'Institucion',
                            'tabla'     => 'institucions',
                            'campo'     => $campo,
                            'nombre_archivo' => $institucion->$campo,
                            'titulo'    => ucfirst($campo),
                            'created_at'=> $institucion->created_at,
                            'url'       => asset('imagen/institucion/' . $institucion->$campo),
                            'ruta_disco'=> 'institucion',
                            'ruta_eliminar' => route('eliminarGaleria', ['modelo' => 'institucion', 'id' => $institucion->id, 'campo' => $campo])
                        ]);
                    }
                }
            }
        }

        if ($sort === 'titulo') {
            $imagenes = $imagenes->sortBy('titulo', SORT_REGULAR, $direction === 'desc');
        } elseif ($sort === 'created_at') {
            $imagenes = $imagenes->sortBy('created_at', SORT_REGULAR, $direction === 'desc');
        } else {
            $imagenes = $imagenes->sortBy('id', SORT_REGULAR, $direction === 'desc');
        }

        $perPage = 24;
        $currentPage = $request->get('page', 1);
        $currentItems = $imagenes->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $total = $imagenes->count();
        $paginador = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, $total, $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        $modelos = ['Actividad', 'Empresa', 'Equipo', 'Taller', 'Usuario', 'Categoria', 'Institucion'];

        return view('panel.galeria.index', compact('paginador', 'modelos'));
    }

    public function editar(Request $request)
    {
        $request->validate([
            'modelo' => 'required|string',
            'id'     => 'required|integer',
            'campo'  => 'required|string',
            'nombre' => 'required|string|max:255|ends_with:jpg,jpeg,png,webp,gif'
        ]);

        $modelo = $this->getModelo($request->modelo);
        if (!$modelo) abort(404);

        $registro = $modelo::find($request->id);
        if (!$registro) abort(404);

        $nombreActual = $registro->{$request->campo};
        $nuevoNombre = $request->nombre;

        $disco = $this->getDisk($request->modelo, $request->campo);
        if (Storage::disk($disco)->exists($nuevoNombre)) {
            return back()->with('error', 'Ya existe un archivo con ese nombre en el disco.');
        }

        if (Storage::disk($disco)->exists($nombreActual)) {
            Storage::disk($disco)->move($nombreActual, $nuevoNombre);
        }

        $registro->{$request->campo} = $nuevoNombre;
        $registro->save();

        return redirect()->route('indexGaleria')->with('success', 'Imagen renombrada correctamente.');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'modelo' => 'required|string',
            'id'     => 'required|integer',
            'campo'  => 'required|string'
        ]);

        $modelo = $this->getModelo($request->modelo);
        if (!$modelo) abort(404);

        $registro = $modelo::find($request->id);
        if (!$registro) abort(404);

        $nombreArchivo = $registro->{$request->campo};
        $disco = $this->getDisk($request->modelo, $request->campo);

        if ($nombreArchivo && Storage::disk($disco)->exists($nombreArchivo)) {
            Storage::disk($disco)->delete($nombreArchivo);
        }

        $registro->{$request->campo} = null;
        $registro->save();

        return redirect()->route('indexGaleria')->with('success', 'Imagen eliminada correctamente.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'modelo' => 'required|string',
            'id'     => 'required|integer',
            'campo'  => 'required|string',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $modelo = $this->getModelo($request->modelo);
        if (!$modelo) abort(404);

        $registro = $modelo::find($request->id);
        if (!$registro) abort(404);

        $disco = $this->getDisk($request->modelo, $request->campo);
        $nombreActual = $registro->{$request->campo};

        if ($nombreActual && Storage::disk($disco)->exists($nombreActual)) {
            Storage::disk($disco)->delete($nombreActual);
        }

        $registro->{$request->campo} = $request->file('imagen');
        $registro->save();

        return redirect()->route('indexGaleria')->with('success', 'Imagen subida/reemplazada correctamente.');
    }

    private function getModelo($key)
    {
        $map = [
            'actividad'   => Actividad::class,
            'empresa'     => Empresa::class,
            'equipo'      => Equipo::class,
            'taller'      => Taller::class,
            'usuario'     => User::class,
            'categoria'   => Categoria::class,
            'institucion' => Institucion::class,
        ];
        return $map[$key] ?? null;
    }

    private function getDisk($modeloKey, $campo)
    {
        if ($modeloKey === 'empresa' && $campo === 'imagen1') {
            return 'empresasproductos';
        }
        $discos = [
            'actividad'   => 'actividades',
            'empresa'     => 'empresas',
            'equipo'      => 'equipos',
            'taller'      => 'talleres',
            'usuario'     => 'usuarios',
            'categoria'   => 'categorias',
            'institucion' => 'institucion',
        ];
        return $discos[$modeloKey] ?? 'public';
    }

    private function getUrl($disco, $filename)
    {
        $map = [
            'actividades'       => 'imagen/actividades/',
            'empresas'          => 'imagen/empresas/',
            'empresasproductos' => 'imagen/empresasproductos/',
            'equipos'           => 'imagen/equipos/',
            'talleres'          => 'imagen/talleres/',
            'usuarios'          => 'imagen/usuarios/',
            'categorias'        => 'imagen/categorias/',
            'institucion'       => 'imagen/institucion/',
        ];
        $base = $map[$disco] ?? 'imagen/';
        return asset($base . $filename);
    }
}
<?php

namespace App\Http\Controllers\Panel;

use App\Models\Empresa;
use App\Models\Categoria;
use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class controllerEmpresa extends Controller
{
    public function index(Request $request)
    {
        $query = Empresa::with(['categoria', 'ciudad']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                ->orWhere('descripcion', 'LIKE', "%{$search}%")
                ->orWhere('telefono', 'LIKE', "%{$search}%")
                ->orWhereHas('categoria', fn($cat) => $cat->where('nombre', 'LIKE', "%{$search}%"))
                ->orWhereHas('ciudad', fn($ciu) => $ciu->where('nombre', 'LIKE', "%{$search}%"));
            });
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }
        if ($request->filled('ciudad_id')) {
            $query->where('ciudad_id', $request->ciudad_id);
        }
        if ($request->filled('activo') && in_array($request->activo, ['0','1'])) {
            $query->where('activo', $request->activo);
        }
        if ($request->filled('aliadas') && in_array($request->aliadas, ['0','1'])) {
            $query->where('aliadas', $request->aliadas);
        }
        if ($request->filled('destacado') && in_array($request->destacado, ['0','1'])) {
            $query->where('destacado', $request->destacado);
        }

        $sortField = $request->get('sort_field', 'prioridad');
        $sortDir = $request->get('sort_dir', 'asc');
        $allowedSortFields = ['prioridad', 'nombre', 'created_at'];
        if (in_array($sortField, $allowedSortFields)) {
            $query->orderBy($sortField, $sortDir === 'desc' ? 'desc' : 'asc');
        } else {
            $query->orderBy('prioridad', 'asc');
        }

        $empresas = $query->paginate(20);
        $empresas->appends($request->only('search', 'categoria_id', 'ciudad_id', 'activo', 'aliadas', 'destacado', 'sort_field', 'sort_dir'));

        $categorias = Categoria::orderBy('nombre')->get();
        $ciudades = Ciudad::orderBy('nombre')->get();

        return view('panel.empresas.index', compact('empresas', 'categorias', 'ciudades'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $ciudades   = Ciudad::orderBy('nombre')->get();

        return view('panel.empresas.create', compact('categorias', 'ciudades'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'telefono'     => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
            'facebook'     => 'nullable|url|max:500',
            'web'          => 'nullable|url|max:500',
            'direccion'    => 'required|string|max:500',
            'promocion'    => 'nullable|string|max:500',
            'descuento'    => 'nullable|string|max:255',
            'horario'      => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'ciudad_id'    => 'required|exists:ciudads,id',
            'video'        => 'nullable|string|max:255',
            'videof'       => 'nullable|url|max:500',
            'latitud'      => 'nullable|numeric',
            'longitud'     => 'nullable|numeric',
            'mapa'         => 'nullable|string|max:1000',
            'prioridad'    => 'nullable|integer|min:0',
            'imagen'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'imagen1'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['slug']    = Str::slug($request->nombre);
        $data['activo']  = 1;
        $data['nvisitas'] = 0;

        $empresa = new Empresa($data);
        $empresa->usuario_id = auth()->id(); 

        if ($request->hasFile('imagen')) {
            $empresa->setImagenAttribute($request->file('imagen'));
        }
        if ($request->hasFile('imagen1')) {
            $empresa->setImagen1Attribute($request->file('imagen1'));
        }

        $empresa->save();

        return redirect()->route('indexEmpresa')->with('success', 'Empresa creada correctamente.');
    }

    public function edit(Empresa $empresa)
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $ciudades   = Ciudad::orderBy('nombre')->get();

        return view('panel.empresas.edit', compact('empresa', 'categorias', 'ciudades'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
            'telefono'     => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
            'facebook'     => 'nullable|url|max:500',
            'web'          => 'nullable|url|max:500',
            'direccion'    => 'nullable|string|max:500',
            'promocion'    => 'nullable|string|max:500',
            'descuento'    => 'nullable|string|max:255',
            'horario'      => 'nullable|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'ciudad_id'    => 'required|exists:ciudads,id',
            'video'        => 'nullable|string|max:255',
            'videof'       => 'nullable|url|max:500',
            'latitud'      => 'nullable|numeric',
            'longitud'     => 'nullable|numeric',
            'mapa'         => 'nullable|string|max:1000',
            'prioridad'    => 'nullable|integer|min:0',
            'imagen'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'imagen1'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['slug'] = Str::slug($request->nombre);

        if ($request->hasFile('imagen')) {
            if ($empresa->imagen && Storage::disk('empresas')->exists($empresa->imagen)) {
                Storage::disk('empresas')->delete($empresa->imagen);
            }
            $empresa->setImagenAttribute($request->file('imagen'));
        }
        unset($data['imagen']);

        if ($request->hasFile('imagen1')) {
            if ($empresa->imagen1 && Storage::disk('empresasproductos')->exists($empresa->imagen1)) {
                Storage::disk('empresasproductos')->delete($empresa->imagen1);
            }
            $empresa->setImagen1Attribute($request->file('imagen1'));
        }
        unset($data['imagen1']);

        $empresa->update($data);

        return redirect()->route('indexEmpresa')->with('success', 'Empresa actualizada correctamente.');
    }

    public function destroy(Empresa $empresa)
    {
        if ($empresa->imagen && Storage::disk('empresas')->exists($empresa->imagen)) {
            Storage::disk('empresas')->delete($empresa->imagen);
        }
        if ($empresa->imagen1 && Storage::disk('empresasproductos')->exists($empresa->imagen1)) {
            Storage::disk('empresasproductos')->delete($empresa->imagen1);
        }

        $empresa->delete();

        return redirect()->route('indexEmpresa')
            ->with('success', 'Empresa eliminada correctamente.');
    }

    public function toggleActivo(Empresa $empresa)
    {
        $empresa->update(['activo' => !$empresa->activo]);
        return back()->with('success', 'Estado actualizado.');
    }

    public function toggleDestacado(Empresa $empresa)
    {
        $empresa->update(['destacado' => !$empresa->destacado]);
        return back()->with('success', 'Destacado actualizado.');
    }

    public function toggleAliadas(Empresa $empresa)
    {
        $empresa->update(['aliadas' => !$empresa->aliadas]);
        return back()->with('success', 'Aliada actualizado.');
    }

    public function toggleComision(Empresa $empresa)
    {
        $empresa->update(['comision' => !$empresa->comision]);
        return back()->with('success', 'Comisión actualizada.');
    }
}
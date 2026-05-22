<?php

namespace App\Http\Controllers\Panel;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class controllerCategoria extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();        
        return view('panel.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('panel.categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'required|string',
            'icono'       => 'nullable|string|max:100',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['slug'] = Str::slug($request->nombre);
        $data['imagen'] = null;

        $categoria = new Categoria($data);

        if ($request->hasFile('imagen')) {
            $categoria->setImagenAttribute($request->file('imagen'));
        }

        $categoria->save();

        return redirect()->route('indexCategoria')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Categoria $categoria)
    {
        return view('panel.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'required|string',
            'icono'       => 'nullable|string|max:100',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['slug'] = Str::slug($request->nombre);
        unset($data['imagen']);

        if ($request->hasFile('imagen')) {
            if ($categoria->imagen && Storage::disk('categorias')->exists($categoria->imagen)) {
                Storage::disk('categorias')->delete($categoria->imagen);
            }
            $categoria->setImagenAttribute($request->file('imagen'));
        }

        $categoria->update($data);

        return redirect()->route('indexCategoria')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->empresas()->count() > 0) {
            return back()->with('error', 'No se puede eliminar la categoría porque tiene empresas asociadas.');
        }

        if ($categoria->imagen && Storage::disk('categorias')->exists($categoria->imagen)) {
            Storage::disk('categorias')->delete($categoria->imagen);
        }

        $categoria->delete();

        return redirect()->route('indexCategoria')->with('success', 'Categoría eliminada correctamente.');
    }
}
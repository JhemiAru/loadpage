<?php

namespace App\Http\Controllers\Panel;

use App\Models\Pais;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class controllerPais extends Controller
{
    public function index()
    {
        $paises = Pais::orderBy('nombre', 'asc')->get();
        return view('panel.paises.index', compact('paises'));
    }

    public function create()
    {
        return view('panel.paises.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255|unique:pais,nombre',
        ]);

        Pais::create($data);

        return redirect()->route('indexPais')->with('success', 'País creado correctamente.');
    }

    public function edit(Pais $pai)
    {
        return view('panel.paises.edit', compact('pai'));
    }

    public function update(Request $request, Pais $pai)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255|unique:pais,nombre,' . $pai->id,
        ]);

        $pai->update($data);

        return redirect()->route('indexPais')->with('success', 'País actualizado correctamente.');
    }

    public function destroy(Pais $pai)
    {
        if ($pai->ciudades()->count() > 0) {
            return back()->with('error', 'No se puede eliminar el país porque tiene ciudades asociadas.');
        }

        $pai->delete();
        return redirect()->route('indexPais')->with('success', 'País eliminado correctamente.');
    }
}
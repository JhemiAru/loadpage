<?php

namespace App\Http\Controllers\Panel;

use App\Models\Ciudad;
use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class controllerCiudad extends Controller
{
    public function index()
    {
        $ciudades = Ciudad::with('pais')->orderBy('nombre', 'asc')->get();
        return view('panel.ciudades.index', compact('ciudades'));
    }

    public function create()
    {
        $paises = Pais::orderBy('nombre')->get();
        return view('panel.ciudades.create', compact('paises'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:255|unique:ciudads,nombre',
            'pais_id'  => 'required|exists:pais,id',
            'slug'     => 'required|string|max:255|unique:ciudads,slug',
        ]);
        Ciudad::create($data);
        return redirect()->route('indexCiudad')->with('success', 'Ciudad creada correctamente.');
    }

    public function edit(Ciudad $ciudad)
    {
        $paises = Pais::orderBy('nombre')->get();
        return view('panel.ciudades.edit', compact('ciudad', 'paises'));
    }

    public function update(Request $request, Ciudad $ciudad)
    {
        $data = $request->validate([
            'nombre'   => 'required|string|max:255|unique:ciudads,nombre,' . $ciudad->id,
            'pais_id'  => 'required|exists:pais,id',
            'slug'     => 'required|string|max:255|unique:ciudads,slug,' . $ciudad->id,
        ]);

        $ciudad->update($data);
        return redirect()->route('indexCiudad')->with('success', 'Ciudad actualizada correctamente.');
    }

    public function destroy(Ciudad $ciudad)
    {
        if ($ciudad->empresas()->count() > 0) {
            return back()->with('error', 'No se puede eliminar la ciudad porque tiene empresas asociadas.');
        }

        $ciudad->delete();
        return redirect()->route('indexCiudad')->with('success', 'Ciudad eliminada correctamente.');
    }
}
<?php

namespace App\Http\Controllers\Panel;

use App\Models\Taller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class controllerTaller extends Controller
{
    public function index()
    {
        $talleres = Taller::orderBy('fecha', 'desc')->paginate(10);
        return view('panel.talleres.index', compact('talleres'));
    }

    public function create()
    {
        return view('panel.talleres.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha'       => 'required|date',
            'horario'     => 'required|string|max:255',
            'lugar'       => 'required|string|max:500',
            'costo'       => 'required|numeric|min:0',
            'detalles'    => 'nullable|string',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        Taller::create($data);

        return redirect()->route('indexTaller')->with('success', 'Taller creado correctamente.');
    }

    public function edit(Taller $taller)
    {
        return view('panel.talleres.edit', compact('taller'));
    }

    public function update(Request $request, Taller $taller)
    {
        $data = $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha'       => 'required|date',
            'horario'     => 'required|string|max:255',
            'lugar'       => 'required|string|max:500',
            'costo'       => 'required|numeric|min:0',
            'detalles'    => 'nullable|string',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($taller->imagen && Storage::disk('talleres')->exists($taller->imagen)) {
                Storage::disk('talleres')->delete($taller->imagen);
            }
            $data['imagen'] = $request->file('imagen');
        } else {
            unset($data['imagen']); 
        }
        $taller->update($data);

        return redirect()->route('indexTaller')->with('success', 'Taller actualizado correctamente.');
    }

    public function destroy(Taller $taller)
    {        
        if ($taller->imagen && Storage::disk('talleres')->exists($taller->imagen)) {
            Storage::disk('talleres')->delete($taller->imagen);
        }

        $taller->delete();

        return redirect()->route('indexTaller')->with('success', 'Taller eliminado correctamente.');
    }
}

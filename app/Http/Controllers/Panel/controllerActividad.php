<?php

namespace App\Http\Controllers\Panel;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class controllerActividad extends Controller
{
    public function index(Request $request)
    {
        $query = Actividad::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhere('tipo', 'LIKE', "%{$search}%");
            });
        }
        $actividades = $query->orderBy('fecha', 'desc')->paginate(12);
        $actividades->appends($request->only('search'));

        return view('panel.actividades.index', compact('actividades'));
    }

    public function create()
    {
        return view('panel.actividades.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha'       => 'required|date',
            'tipo'        => 'required|in:actividad,noticia',
            'activo'      => 'nullable|boolean',
            'imagen'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['activo'] = $request->boolean('activo');

        $actividad = new Actividad($data);

        if ($request->hasFile('imagen')) {
            $actividad->setImagenAttribute($request->file('imagen'));
        }

        $actividad->save();

        return redirect()->route('indexActividad')->with('success', 'Actividad creada correctamente.');
    }

    public function edit(Actividad $actividad)
    {
        return view('panel.actividades.edit', compact('actividad'));
    }

    public function update(Request $request, Actividad $actividad)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha'       => 'required|date',
            'tipo'        => 'required|in:actividad,noticia',
            'activo'      => 'nullable|boolean',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['activo'] = $request->boolean('activo');

        if ($request->hasFile('imagen')) {
            if ($actividad->imagen && Storage::disk('actividades')->exists($actividad->imagen)) {
                Storage::disk('actividades')->delete($actividad->imagen);
            }
            $actividad->setImagenAttribute($request->file('imagen'));
        }

        unset($data['imagen']);

        $actividad->update($data);

        return redirect()->route('indexActividad')->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy(Actividad $actividad)
    {
        if ($actividad->imagen && Storage::disk('actividades')->exists($actividad->imagen)) {
            Storage::disk('actividades')->delete($actividad->imagen);
        }

        $actividad->delete();

        return redirect()->route('indexActividad')->with('success', 'Actividad eliminada correctamente.');
    }

    public function toggleActivo(Actividad $actividad)
    {
        $actividad->update(['activo' => !$actividad->activo]);
        return back()->with('success', 'Estado actualizado.');
    }
}
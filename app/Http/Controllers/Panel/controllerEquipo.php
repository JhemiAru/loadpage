<?php

namespace App\Http\Controllers\Panel;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class controllerEquipo extends Controller
{
    public function index()
    {
        $equipo = Equipo::orderBy('id', 'desc')->get();
        return view('panel.equipo.index', compact('equipo'));
    }

    public function create()
    {
        return view('panel.equipo.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'cargo'       => 'required|string|max:255',
            'descripcion' => 'required|string',
            'facebook'    => 'nullable|string|max:255',
            'twitter'     => 'nullable|string|max:255',
            'instagram'   => 'nullable|string|max:255',
            'estado'      => 'required|boolean',
            'imagen'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['facebook'] = $request->filled('facebook') ? $request->facebook : 'sdf';
        $data['estado']   = $request->boolean('estado');

        $equipo = new Equipo($data);

        if ($request->hasFile('imagen')) {
            $equipo->setImagenAttribute($request->file('imagen'));
        }

        $equipo->save();

        return redirect()->route('indexEquipo')
            ->with('success', 'Miembro del equipo creado correctamente.');
    }

    public function edit(Equipo $equipo)
    {
        return view('panel.equipo.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'cargo'       => 'required|string|max:255',
            'descripcion' => 'required|string',
            'facebook'    => 'nullable|string|max:255',
            'twitter'     => 'nullable|string|max:255',
            'instagram'   => 'nullable|string|max:255',
            'estado'      => 'required|boolean',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['facebook'] = $request->filled('facebook') ? $request->facebook : 'sdf';
        $data['estado']   = $request->boolean('estado');

        if ($request->hasFile('imagen')) {
            if ($equipo->imagen && Storage::disk('equipos')->exists($equipo->imagen)) {
                Storage::disk('equipos')->delete($equipo->imagen);
            }
            $equipo->setImagenAttribute($request->file('imagen'));
        }

        unset($data['imagen']); 
        $equipo->update($data);

        return redirect()->route('indexEquipo')
            ->with('success', 'Miembro del equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        if ($equipo->imagen && Storage::disk('equipos')->exists($equipo->imagen)) {
            Storage::disk('equipos')->delete($equipo->imagen);
        }
        $equipo->delete();

        return redirect()->route('indexEquipo')
            ->with('success', 'Miembro del equipo eliminado correctamente.');
    }

    public function toggleEstado(Equipo $equipo)
    {
        $equipo->update(['estado' => !$equipo->estado]);
        return back()->with('success', 'Estado actualizado.');
    }
}
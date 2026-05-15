<?php

namespace App\Http\Controllers\Panel;

use App\Models\Taller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class controllerTaller extends Controller
{
    // ── Listado ─────────────────────────────────────────────
    public function index()
    {
        $talleres = Taller::orderBy('fecha', 'desc')->paginate(10);
        return view('panel.talleres.index', compact('talleres'));
    }

    // ── Formulario crear ────────────────────────────────────
    public function create()
    {
        return view('panel.talleres.create');
    }

    // ── Guardar nuevo ───────────────────────────────────────
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

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')
                ->store('talleres', 'public');
        }

        Taller::create($data);

        return redirect()->route('panel.talleres.index')
            ->with('success', 'Taller creado correctamente.');
    }

    // ── Formulario editar ───────────────────────────────────
    public function edit(Taller $taller)
    {
        return view('panel.talleres.edit', compact('taller'));
    }

    // ── Actualizar ──────────────────────────────────────────
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
            // Eliminar imagen anterior si existe
            if ($taller->imagen) {
                Storage::disk('public')->delete($taller->imagen);
            }
            $data['imagen'] = $request->file('imagen')
                ->store('talleres', 'public');
        } else {
            unset($data['imagen']); // No sobreescribir si no viene nueva
        }

        $taller->update($data);

        return redirect()->route('panel.talleres.index')
            ->with('success', 'Taller actualizado correctamente.');
    }

    // ── Eliminar ────────────────────────────────────────────
    public function destroy(Taller $taller)
    {
        if ($taller->imagen) {
            Storage::disk('public')->delete($taller->imagen);
        }

        $taller->delete();

        return redirect()->route('panel.talleres.index')
            ->with('success', 'Taller eliminado correctamente.');
    }
}

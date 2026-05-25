<?php

namespace App\Http\Controllers\Panel;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class controllerPerfil extends Controller
{
    public function show()
    {
        $user     = Auth::user();
        $ciudades = Ciudad::orderBy('nombre')->get();

        return view('panel.perfil', compact('user', 'ciudades'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'nombre'    => 'required|string|max:100',
            'apellido'  => 'required|string|max:100',
            'ci'        => 'required|string|max:20|unique:users,ci,' . $user->id,
            'celular'   => 'required|string|max:20',
            'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'ciudad_id' => 'required|exists:ciudads,id',
            'direccion' => 'nullable|string|max:500',
            'imagen'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $request->validate($rules);

        $user->nombre    = $request->nombre;
        $user->apellido  = $request->apellido;
        $user->ci        = $request->ci;
        $user->celular   = $request->celular;
        $user->email     = $request->email;
        $user->ciudad_id = $request->ciudad_id;
        $user->direccion = $request->direccion;

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            if ($user->imagen && Storage::disk('usuarios')->exists($user->imagen)) {
                Storage::disk('usuarios')->delete($user->imagen);
            }
            $user->setImagenAttribute($request->file('imagen'));
        }

        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}
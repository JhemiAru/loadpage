<?php

namespace App\Http\Controllers\Panel;

use App\Models\User;
use App\Models\Ciudad;
use App\Models\Rango;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class controllerUsuario extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['ciudad', 'rango']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('apellido', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('ci', 'LIKE', "%{$search}%")
                  ->orWhere('celular', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('tipo') && in_array($request->tipo, ['admin', 'user', 'empresa'])) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('activo') && in_array($request->activo, ['0', '1'])) {
            $query->where('activo', $request->activo);
        }

        $usuarios = $query->orderBy('id', 'desc')->paginate(15);
        $usuarios->appends($request->only('search', 'tipo', 'activo'));

        return view('panel.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $ciudades = Ciudad::orderBy('nombre')->get();
        $rangos   = Rango::orderBy('nombre')->get();
        $usuariosReferidos = User::orderBy('nombre')->get();
        return view('panel.usuarios.create', compact('ciudades', 'rangos', 'usuariosReferidos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'apellido'    => 'required|string|max:255',
            'ci'          => 'required|string|max:20|unique:users,ci',
            'direccion'   => 'nullable|string|max:500',
            'celular'     => 'required|string|max:20',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6',
            'tipo'        => 'required|in:Usuario,Administrador,Empresa,Sadministrador',
            'activo'      => 'nullable|boolean',
            'ciudad_id'   => 'required|exists:ciudads,id',
            'rango_id'    => 'nullable|exists:rangos,id',
            'dinero'      => 'nullable|numeric|min:0',
            'codigo'      => 'required|string|max:50',
            'cod_face'    => 'required|string|max:50',
            'user_id'     => 'nullable|exists:users,id',
            'imagen'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['activo'] = $request->boolean('activo');

        $usuario = new User($data);
        if ($request->hasFile('imagen')) {
            $usuario->setImagenAttribute($request->file('imagen'));
        }
        $usuario->save();

        return redirect()->route('indexUsuario')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario)
    {
        $ciudades = Ciudad::orderBy('nombre')->get();
        $rangos = Rango::orderBy('nombre')->get();
        $usuariosReferidos = User::where('id', '!=', $usuario->id)->orderBy('nombre')->get();
        return view('panel.usuarios.edit', compact('usuario', 'ciudades', 'rangos', 'usuariosReferidos'));
    }

    public function update(Request $request, User $usuario)
    {
        $data = $request->validate([
            'nombre'      => 'required|string|max:255',
            'apellido'    => 'required|string|max:255',
            'ci'          => 'required|string|max:20|unique:users,ci,' . $usuario->id,
            'direccion'   => 'nullable|string|max:500',
            'celular'     => 'required|string|max:20',
            'email'       => 'required|email|unique:users,email,' . $usuario->id,
            'password'    => 'nullable|string|min:6',
            'tipo'        => 'required|in:Usuario,Administrador,Empresa,Sadministrador',
            'activo'      => 'nullable|boolean',
            'ciudad_id'   => 'required|exists:ciudads,id',
            'rango_id'    => 'nullable|exists:rangos,id',
            'dinero'      => 'nullable|numeric|min:0',
            'codigo'      => 'required|string|max:50',
            'cod_face'    => 'required|string|max:50',
            'user_id'     => 'nullable|exists:users,id',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['activo'] = $request->boolean('activo');

        if ($request->filled('password')) {
            $usuario->password = $request->password;
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('imagen')) {
            if ($usuario->imagen && Storage::disk('usuarios')->exists($usuario->imagen)) {
                Storage::disk('usuarios')->delete($usuario->imagen);
            }
            $usuario->setImagenAttribute($request->file('imagen'));
        }
        unset($data['imagen']);

        $usuario->update($data);

        return redirect()->route('indexUsuario')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        if ($usuario->empresas()->count() > 0) {
            return back()->with('error', 'No se puede eliminar el usuario porque tiene empresas o publicaciones asociadas.');
        }

        if ($usuario->imagen && Storage::disk('usuarios')->exists($usuario->imagen)) {
            Storage::disk('usuarios')->delete($usuario->imagen);
        }

        $usuario->delete();
        return redirect()->route('indexUsuario')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    public function toggleActivo(User $usuario)
    {
        $usuario->update(['activo' => !$usuario->activo]);
        return back()->with('success', 'Estado actualizado.');
    }
}
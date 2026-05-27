<?php

namespace App\Http\Controllers\Panel;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class controllerInstitucion extends Controller
{
    public function edit()
    {
        $institucion = Institucion::first() ?? new Institucion();
        return view('panel.institucion.edit', compact('institucion'));
    }

    public function update(Request $request)
    {
        $institucion = Institucion::first();
        if (!$institucion) {
            $institucion = new Institucion();
        }

        $data = $request->validate([
            'qSomos'          => 'required|string',
            'frase1'          => 'required|string|max:255',
            'frase2'          => 'required|string|max:255',
            'frase3'          => 'required|string|max:255',
            'trabaja'         => 'required|string',
            'direccion'       => 'required|string|max:500',
            'celular'         => 'required|string|max:20',
            'celular2'        => 'required|string|max:20',
            'telefono'        => 'required|string|max:20',
            'email'           => 'required|email|max:255',
            'facebook'        => 'required|url|max:255',
            'tiktok'          => 'required|url|max:255',
            'youtube'         => 'required|url|max:255',
            'instagram'       => 'required|url|max:255',            
            'vision'          => 'required|string',
            'mision'          => 'required|string',
            'desEmpresa'      => 'required|string',
            'titulonoticias'  => 'required|string|max:255',
            'desnoticias'     => 'required|string',
            'tituloactividades'=> 'required|string|max:255',
            'desactividades'  => 'required|string',
            'imgtrabaja'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'titulosomos'     => 'required|string|max:255',
            'titulosuscribir' => 'required|string|max:255',
            'dessuscribir'    => 'required|string',
            'titulotrabaja'   => 'nullable|string|max:255',
            'tituloplan'      => 'required|string|max:255',
            'desplan'         => 'required|string',
            'nombreplan'      => 'required|string|max:255',
            'bsprecio'        => 'required|string|max:50',
            'susprecio'       => 'required|string|max:50',
            'plan'            => 'required|string',
            'benplan1'        => 'required|string|max:255',
            'benplan2'        => 'required|string|max:255',
            'benplan3'        => 'required|string|max:255',
            'benplan4'        => 'required|string|max:255',
            'benplan5'        => 'required|string|max:255',
            'tituloequipo'    => 'required|string|max:255',
            'desequipo'       => 'required|string',
            'tituloempresa'   => 'required|string|max:255',
            'visitas'         => 'required|integer',
            'imagen'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner1'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner2'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner3'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $this->deleteOldImage($institucion->imagen);
            $institucion->setImagenAttribute($request->file('imagen'));
            $data['imagen'] = $institucion->imagen;
        }
        if ($request->hasFile('banner1')) {
            $this->deleteOldImage($institucion->banner1);
            $institucion->setBanner1Attribute($request->file('banner1'));
            $data['banner1'] = $institucion->banner1;
        }
        if ($request->hasFile('banner2')) {
            $this->deleteOldImage($institucion->banner2);
            $institucion->setBanner2Attribute($request->file('banner2'));
            $data['banner2'] = $institucion->banner2;
        }
        if ($request->hasFile('banner3')) {
            $this->deleteOldImage($institucion->banner3);
            $institucion->setBanner3Attribute($request->file('banner3'));
            $data['banner3'] = $institucion->banner3;
        }
        if ($request->hasFile('imgtrabaja')) {
            $this->deleteOldImage($institucion->imgtrabaja);
            $name = time() . '_' . $request->file('imgtrabaja')->getClientOriginalName();
            $path = $request->file('imgtrabaja')->storeAs('', $name, 'institucion');
            $data['imgtrabaja'] = $path;
        }

        unset($data['imagen'], $data['banner1'], $data['banner2'], $data['banner3'], $data['imgtrabaja']);

        $institucion->fill($data);
        $institucion->save();

        return redirect()->route('editarInstitucion')
            ->with('success', 'Datos de la institución actualizados correctamente.');
    }

    private function deleteOldImage($filename)
    {
        if ($filename && Storage::disk('institucion')->exists($filename)) {
            Storage::disk('institucion')->delete($filename);
        }
    }
}
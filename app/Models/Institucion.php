<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
class Institucion extends Model
    {
    protected $table="institucions";
    protected $fillable=[
      'qSomos',
      'frase1',
      'frase2',
      'frase3',
      'trabaja',
      'direccion',
      'celular',
      'telefono',
      'email',
      'facebook',
      'tiktok',
      'youtube',
      'instagram',
      'google',
      'imagen',
      'vision',
      'mision',
      'desEmpresa',
      'banner1',
      'banner2',
      'banner3',
      'titulonoticias',
      'desnoticias',
      'tituloactividades',
      'desactividades',
      'imgtrabaja',
      'titulosomos',
      'titulosuscribir',
      'dessuscribir',
      'titulotrabaja',
      'tituloplan',
      'desplan',
      'nombreplan',
      'bsprecio',
      'susprecio',
      'plan',
      'benplan1',
      'benplan2',
      'benplan3',
      'benplan4',
      'benplan5',
      'tituloequipo',
      'desequipo',
      'tituloempresa',
      'visitas'
    ];

    public function setImagenAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['imagen'] = $name;
            Storage::disk('institucion')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['imagen'] = $value;
        }
    }

    public function setBanner1Attribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['banner1'] = $name;
            Storage::disk('institucion')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['banner1'] = $value;
        }
    }

    public function setBanner2Attribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['banner2'] = $name;
            Storage::disk('institucion')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['banner2'] = $value;
        }
    }

    public function setBanner3Attribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['banner3'] = $name;
            Storage::disk('institucion')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['banner3'] = $value;
        }
    }

    public function setImgtrabajaAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['imgtrabaja'] = $name;
            Storage::disk('institucion')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['imgtrabaja'] = $value;
        }
    }
}

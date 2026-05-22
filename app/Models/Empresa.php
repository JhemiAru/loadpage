<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nombre', 'descripcion', 'telefono', 'email', 'facebook',
        'direccion', 'promocion', 'descuento', 'horario', 'web',
        'categoria_id', 'imagen', 'imagen1', 'usuario_id', 'ciudad_id',
        'activo', 'destacado', 'aliadas', 'comision',
        'video', 'videof', 'latitud', 'longitud', 'slug', 'prioridad',
        'nvisitas', 'mapa',
    ];

    protected $casts = [
        'activo'    => 'boolean',
        'destacado' => 'boolean',
        'aliadas'   => 'boolean',
        'comision'  => 'boolean',
    ];

    public function setImagenAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['imagen'] = $name;
            Storage::disk('empresas')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['imagen'] = $value;
        }
    }

    public function setImagen1Attribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['imagen1'] = $name;
            Storage::disk('empresasproductos')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['imagen1'] = $value;
        }
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
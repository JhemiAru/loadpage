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

    public function setImagenAttribute($imagen)
    {
        if (!empty($imagen) && is_object($imagen)) {
            $disk = Storage::disk('empresas');
            $name = Carbon::now()->timestamp . '_' . $imagen->getClientOriginalName();
            $disk->put($name, file_get_contents($imagen));
            $this->attributes['imagen'] = $name;
        }
    }

    public function setImagen1Attribute($imagen1)
    {
        if (!empty($imagen1) && is_object($imagen1)) {
            $disk = Storage::disk('empresasproductos');
            $name = Carbon::now()->timestamp . '_' . $imagen1->getClientOriginalName();
            $disk->put($name, file_get_contents($imagen1));
            $this->attributes['imagen1'] = $name;
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
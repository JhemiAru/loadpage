<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table='actividads';
    protected $fillable=['nombre','descripcion','imagen','fecha','activo','tipo'];
    protected $casts = [
        'fecha'  => 'date',
        'activo' => 'boolean',
    ];
    public function setImagenAttribute($imagen)
    {
        if (!empty($imagen) && is_object($imagen)) {
            $name = Carbon::now()->timestamp . '_' . $imagen->getClientOriginalName();
            Storage::disk('actividades')->put($name, file_get_contents($imagen));
            $this->attributes['imagen'] = $name;
        }
    }
}

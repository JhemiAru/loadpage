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
    public function setImagenAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['imagen'] = $name;
            Storage::disk('actividades')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['imagen'] = $value;
        }
    }
}

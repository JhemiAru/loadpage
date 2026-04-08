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
    public function setImagenAttribute($imagen){
        if(! empty($imagen)){
              $name = Carbon::now()->second.$imagen->getClientOriginalName();
              $this->attributes['imagen'] = $name;
              Storage::disk('actividades')->put($name, File::get($imagen));
        }
    }
}

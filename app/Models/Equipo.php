<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
class Equipo extends Model
{
    protected $table='equipos';
    protected $fillable=['nombre','imagen','facebook','twitter','instagram','descripcion','estado','cargo'];
    public function setImagenAttribute($imagen){
        if(! empty($imagen)){
              $name = Carbon::now()->second.$imagen->getClientOriginalName();
              $this->attributes['imagen'] = $name;
              Storage::disk('equipos')->put($name, File::get($imagen));
        }
    }
}

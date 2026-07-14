<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class Producto extends Model
{
     protected $table="productos";
    protected $fillable=['empresa_id','nombre','descripcion','precio','imagen','activo','descuento','tipo','comision'];

    public function setImagenAttribute($imagen){
        if(! empty($imagen)){
              $name = Carbon::now()->second.$imagen->getClientOriginalName();
              $this->attributes['imagen'] = $name;
              Storage::disk('productos')->put($name, File::get($imagen));
        }
    }
}

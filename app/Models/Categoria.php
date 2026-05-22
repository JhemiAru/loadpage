<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class Categoria extends Model
{
    protected $table='categorias';
    protected $fillable=['nombre','descripcion','imagen','icono','slug'];

    public function setImagenAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['imagen'] = $name;
            Storage::disk('categorias')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['imagen'] = $value;
        }
    }
    
    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
}



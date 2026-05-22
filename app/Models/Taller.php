<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class Taller extends Model
{
    protected $table = 'tallers';
 
    protected $fillable = ['titulo','descripcion','fecha','horario','lugar','imagen','costo','detalles'];

    public function setImagenAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['imagen'] = $name;
            Storage::disk('talleres')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['imagen'] = $value;
        }
    }

    protected $casts = [
        'fecha'  => 'date',
        'costo'  => 'decimal:2',
    ];

}

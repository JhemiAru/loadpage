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

    public function setImagenAttribute($imagen)
    {
        if (!empty($imagen) && is_object($imagen)) {
            $disk = Storage::disk('talleres');
            $originalName = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $imagen->getClientOriginalExtension();            
            $name = $originalName . '.' . $extension;
            $counter = 1;
            while ($disk->exists($name)) {
                $name = $originalName . '(' . $counter . ').' . $extension;
                $counter++;
            }
            $this->attributes['imagen'] = $name;
            $disk->putFileAs('', $imagen, $name);
        }
    }

    protected $casts = [
        'fecha'  => 'date',
        'costo'  => 'decimal:2',
    ];

}

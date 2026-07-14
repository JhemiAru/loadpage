<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class Rango extends Model
{
    protected $table= 'rangos';
    protected $fillable=[
        'nombre',
        'bono',
        'numeroLider',
        'numeroTeam',
        'imagen'
    ];

    public function setImagenAttribute($imagen)
    {
        if(! empty($imagen)){
            $name = Carbon::now()->second.$imagen->getClientOriginalName();
            $this->attributes['imagen'] = $name;
            Storage::disk('rangos')->put($name, File::get($imagen));
      }
    }
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
class Publicacion extends Model
{
    protected $table='publicacions';
    protected $fillable=[
    	'imagen',
    	'archivo',
    	'descripcion',
    	'usuario_id',
        'likes',
    	'created_at'
    ];
    public function setImagenAttribute($imagen){
        if(! empty($imagen)){
              $name = Carbon::now()->second.$imagen->getClientOriginalName();
              $this->attributes['imagen'] = $name;
              Storage::disk('publicaciones')->put($name, File::get($imagen));
        }
    }
    public function setArchivoAttribute($archivo){
        if(! empty($archivo)){
              $name = Carbon::now()->second.$archivo->getClientOriginalName();
              $this->attributes['archivo'] = $name;
              Storage::disk('publicaciones')->put($name, File::get($archivo));
        }
    }
    public function user()
    {
    	return $this->belongsTo(User::class,'usuario_id');
    }
    public function likess()
    {
        return $this->hasMany(Likes::class);
    }
}

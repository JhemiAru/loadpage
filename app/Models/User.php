<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Publicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Empresa;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ciudad_id','nombre', 'apellido','ci','direccion','celular','email', 'password','imagen','codigo','tipo','activo','cod_face','rango_id','dinero','user_id'  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setImagenAttribute($imagen){
        if(! empty($imagen)){
              $name = Carbon::now()->second.$imagen->getClientOriginalName();
              $this->attributes['imagen'] = $name;
              Storage::disk('usuarios')->put($name, File::get($imagen));
        }
    }
    public function setPasswordAttribute($valor)
    {
        if(!empty($valor)){
            $this->attributes['password'] = Hash::make($valor);
        }
    }
    public function setImagenEmpAttribute($imagen1){
        if(! empty($imagen1)){
              $name1 = Carbon::now()->second.$imagen1->getClientOriginalName();
              $this->attributes['imagen'] = $name1;
              Storage::disk('usuempresas')->put($name1, File::get($imagen1));
        }
    }
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function publicaciones()
    {
      return $this->hasMany(Publicacion::class);
    }
    public function likes()
    {
      return $this->hasMany(Likes::class);
    }
    public function rango()
    {
        return $this->belongsTo(Rango::class,'rango_id');
    }
}

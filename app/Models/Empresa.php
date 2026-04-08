<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
class Empresa extends Model
{
    protected $table="empresas";
    protected $fillable=['nombre','descripcion','telefono','email','facebook','direccion','promocion','descuento','horario','web','categoria_id','imagen','imagen1','usuario_id','ciudad_id','activo','destacado','aliadas','comision','video','latitud','longitud','slug','prioridad','nvisitas','mapa','videof'];
    public function setImagenAttribute($imagen){
        if(!empty($imagen)){
              $name = Carbon::now()->second.$imagen->getClientOriginalName();
              $this->attributes['imagen'] = $name;
              Storage::disk('empresas')->put($name,File::get($imagen));
            //dd($name);
            }        
    }
     public function setImagen1Attribute($imagen1){
        if(!empty($imagen1)){
              $name1 = Carbon::now()->second.$imagen1->getClientOriginalName();
              $this->attributes['imagen1'] = $name1;
              Storage::disk('empresasproductos')->put($name1,File::get($imagen1));
        }
    }
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    } 
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

     public function ciudades()
    {
        return $this->belongstomany(Ciudad::class);
    } 
    public function ciudadesempresa()
    {
        return $this->hasMany(CiudadesEmpresa::class,'ciudad_id');
    }
    
}

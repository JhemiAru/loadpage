<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table='ciudads';
    protected $fillable=['nombre','pais_id','slug'];

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }

    public function empresas()
    {
        return $this->hasMany(User::class);
    }
    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }
   public function cempresas()
    {
        return $this->belongsToMany(Empresa::class);
    }
    public function empresaciudades()
    {
        return $this->hasMany(CiudadesEmpresa::class,'empresa_id');
    } 
    public function m_empresas()
    {
        return $this->hasMany(Empresa::class);
    }
}

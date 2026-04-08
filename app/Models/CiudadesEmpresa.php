<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CiudadesEmpresa extends Model
{
    protected $table="ciudades_empresas";
    protected $fillable=['empresa_id','ciudad_id'];

    public function ciudadess()
    {
        return $this->belongsTo(Ciudad::class,'ciudad_id','id');
    } 

    public function empresas()
    {
        return $this->belongsTo(Empresa::class,'empresa_id','id');
    }
    

}

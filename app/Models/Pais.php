<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table='pais';
    protected $fillable=['nombre'];
    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }
}

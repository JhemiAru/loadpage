<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionRango extends Model
{
    protected $table = 'asignacion_rangos';
    protected $fillable = [
        'usuario_id',
        'rango_id',
    ];
}

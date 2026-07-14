<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaTarjetas extends Model
{
    protected $table="venta_tarjetas";
    protected $fillable=[
        'id',
        'usuario_id',
    ];
    public function usuario()
    {
        return $this->belogsTo(User::class,'usuario_id');
    }
}

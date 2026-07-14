<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table='teams';
    protected $fillable=[
        'lider_id',
        'usuario_id',
    ];
    public function lider()
    {
        return $this->belongsTo(User::class,'lider_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}

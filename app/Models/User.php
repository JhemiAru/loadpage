<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'ciudad_id', 'nombre', 'apellido', 'ci', 'direccion', 'celular', 'email', 
        'password', 'imagen', 'codigo', 'tipo', 'activo', 'cod_face', 'rango_id', 
        'dinero', 'user_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'dinero' => 'decimal:2',
    ];

    public function setImagenAttribute($value)
    {
        if ($value instanceof \Illuminate\Http\UploadedFile) {
            $name = Carbon::now()->second . $value->getClientOriginalName();
            $this->attributes['imagen'] = $name;
            Storage::disk('usuarios')->put($name, \File::get($value));
        } elseif (is_string($value)) {
            $this->attributes['imagen'] = $value;
        }
    }

    public function setPasswordAttribute($valor)
    {
        if(!empty($valor)){
            $this->attributes['password'] = Hash::make($valor);
        }
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'usuario_id');
    }

    public function referidoPor()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function referidos()
    {
        return $this->hasMany(User::class, 'usuario_id');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function rango()
    {
        return $this->belongsTo(Rango::class, 'rango_id');
    }

    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }
}
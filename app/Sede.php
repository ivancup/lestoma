<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'sedes_usuarios', 'fk_sede', 'fk_usuario');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion', 'protocolo'
    ];
}

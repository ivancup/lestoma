<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'valor'
    ];

    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'estados';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}

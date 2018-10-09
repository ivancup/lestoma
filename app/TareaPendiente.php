<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareaPendiente extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tareas_pendientes';

    /**
     * LLave primaria del modelo.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function protocolo()
    {
        return $this->belongsTo(Protocolo::class, 'fk_protocolo', 'id');
    }

    /**
     * se ejecuta cada vez que se elimina un proceso verifica si existe
     * un archivo de autoevaluacion y lo elimina en
     * caso de existir del servidor
     */
    public static function boot()
    {
        parent::boot();
        // static::deleting(function ($model) {
        //     $procesos = $model::
        // });

    }
}

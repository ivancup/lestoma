<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosHistorico extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'datos_historicos';

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

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'fk_sede', 'id');
    }
}

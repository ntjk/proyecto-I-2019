<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $fk_zona_empleado_1
 * @property int $fk_zona_empleado_2
 * @property int $fk_zona_empleado_3
 * @property int $zo_em_ho_clave
 * @property string $fk_horario
 */
class Zoemho extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zona_empleado_horario';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'zo_em_ho_clave';

    /**
     * @var array
     */
    protected $fillable = ['fk_zona_empleado_1', 'fk_zona_empleado_2',' fk_zona_empleado_3', 'fk_horario'];


   /* public function lugar()
    {
        return $this->belongsTo('App\Lugar', 'fk_lugar', 'lu_clave');
    }
    public function envios()
    {
        return $this->hasMany('App\Envio', 'fk_sucursal_origen', 'en_clave');
    }*/
}

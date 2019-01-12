<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $a_clave
 * @property string $a_fecha
 * @property int $fk_zo_em_ho_5
 * @property char $a_check
 */
class Asistencia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'asistencia';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'a_clave';

    /**
     * @var array
     */
    protected $fillable = ['a_check', 'a_fecha', 'fk_zo_em_ho_5'];

    public function zoemho()
    {
        return $this->belongsTo('App\Zoemho', 'fk_zo_em_ho_5', 'zo_em_ho_clave');
    }

    /*public function envios()
    {
        return $this->hasMany('App\Envio', 'fk_sucursal_origen', 'en_clave');
    }*/
}

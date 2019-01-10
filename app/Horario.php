<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ho_clave
 * @property string $ho_hora_entrada
 * @property string $ho_hora_entrada
 * @property int $ho_dia
 */
class Horario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'horario';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ho_clave';

    /**
     * @var array
     */
    protected $fillable = ['ho_hora_entrada', 'ho_hora_salida',' ho_dia'];


    /*public function envios()
    {
        return $this->hasMany('App\Envio', 'fk_sucursal_origen', 'en_clave');
    }*/
}

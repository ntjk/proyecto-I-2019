<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $flo_ru_clave
 * @property int $fk_flota
 * @property int $fk_ruta_1
 * @property int $fk_ruta_2
 * @property int $fk_ruta_3
 * @property int $fk_ruta_4
 * @property int $fk_ruta_5
 * @property float $flo_ru_costo
 * @property float $flo_ru_duracion_hrs
 */
class Floru extends Model
{
    /**
     
     *
     * @var string
     */
    protected $table = 'flota_ruta';
    protected $primaryKey ='flo_ru_clave';

    /**
     * @var array
     */
    protected $fillable = ['fk_ruta_5','fk_ruta_2','fk_ruta_3','fk_ruta_4','flo_ru_duracion_hrs', 'flo_ru_costo', 'fk_flota'];

    public function formaParte()
    {
        return $this->belongsTo('App\Ruta', 'fk_ruta_1', 'ru_clave');
    }
    public function formaParte2()
    {
        return $this->belongsTo('App\Ruta', 'fk_ruta_2', 'fk_sucursal_1');
    }
    public function formaParte3()
    {
        return $this->belongsTo('App\Ruta', 'fk_ruta_3', 'fk_sucursal_2');
    }
}

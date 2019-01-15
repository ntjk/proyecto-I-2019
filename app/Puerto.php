<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $puer_clave
 * @property int $fk_flota
 * @property int $puer_cantidad_puestos
 * @property int $puer_cantidad_muelles
 * @property float $puer_longitud
 * @property float $puer_ancho
 * @property float $puer_calado
 * @property string $puer_uso
 * @property string $puer_nombre
 * @property int $fk_sucursal
 * @property Flotum $flotum
 * @property Area[] $areas
 */
class Puerto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'puerto';
    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'puer_clave';

    /**
     * @var array
     */
    protected $fillable = ['fk_flota', 'puer_cantidad_puestos', 'puer_cantidad_muelles', 'puer_longitud', 'puer_ancho', 'puer_calado', 'puer_uso', 'puer_nombre', 'fk_sucursal'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flotum()
    {
        return $this->belongsTo('App\Flotum', 'fk_flota', 'flo_clave');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areas()
    {
        return $this->hasMany('App\Area', 'ar_clave', 'puer_clave');
    }
}

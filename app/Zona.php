<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $zo_clave
 * @property int $fk_sucursal
 * @property string $zo_nombre
 * @property string $zo_descripcion
 * @property float $zo_ancho
 * @property float $zo_altura
 * @property float $zo_profundidad
 */
class Zona extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zona';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'zo_clave';

    /**
     * @var array
     */
    protected $fillable = ['zo_nombre', 'zo_descripcion', 'zo_ancho', 'zo_altura', 'zo_profundidad', 'fk_sucursal'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sucursal()
    {
        return $this->belongsTo('App\Sucursal', 'fk_sucursal', 'su_clave');
    }
}
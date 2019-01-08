<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ae_clave
 * @property string $ae_nombre
 * @property float $ae_capacidad
 * @property int $ae_cantidad_pistas
 * @property int $ae_cantidad_terminales
 * @property string $ae_otro
 * @property AereaAeropuerto[] $aereaAeropuertos
 */
class Aeropuerto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'aeropuerto';
    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ae_clave';

    /**
     * @var array
     */
    protected $fillable = ['ae_nombre', 'ae_capacidad', 'ae_cantidad_pistas', 'ae_cantidad_terminales', 'ae_otro'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aereaAeropuertos()
    {
        return $this->hasMany('App\AereaAeropuerto', 'fk_aeropuerto', 'ae_clave');
    }
}

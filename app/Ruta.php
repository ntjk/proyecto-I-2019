<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ru_clave
 * @property int $fk_sucursal_1
 * @property int $fk_sucursal_2
 * @property int $fk_ruta
 * @property Sucursal $sucursal
 * @property Sucursal $sucursal
 * @property Rutum $rutum
 */
class Ruta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ruta';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ru_clave';

    /**
     * @var array
     */
    protected $fillable = ['fk_sucursal_1','fk_sucursal_2','fk_ruta'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function origen()
    {
        return $this->belongsToMany('App\Sucursal', 'fk_sucursal_1', 'su_clave');
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function destino()
    {
        return $this->belongsToMany('App\Sucursal', 'fk_sucursal_2', 'su_clave');
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formaParte()
    {
        return $this->hasMany('App\Ruta', 'fk_ruta', 'ru_clave');
    }
     /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  /*  public function florus()
    {
        return $this->hasMany('App\Floru');
    }*/
}

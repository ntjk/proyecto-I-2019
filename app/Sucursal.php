<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $su_clave
 * @property int $fk_lugar
 * @property string $su_nombre
 * @property string $su_email
 * @property float $su_capacidad
 * @property Lugar $lugar
 */
class Sucursal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sucursal';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'su_clave';

    /**
     * @var array
     */
    protected $fillable = ['su_clave', 'fk_lugar', 'su_nombre', 'su_email', 'su_capacidad'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lugar()
    {
        return $this->belongsTo('App\Lugar', 'fk_lugar', 'lu_clave');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function envios()
    {
        return $this->hasMany('App\Envio', 'fk_sucursal_origen', 'en_clave');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function envioRecibidos()
    {
        return $this->hasMany('App\Envio', 'fk_sucursal_destino', 'en_clave');
    }
}

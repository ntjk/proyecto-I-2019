<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $lu_clave
 * @property int $fk_lugar
 * @property string $lu_tipo
 * @property string $lu_nombre
 * @property Lugar $lugar
 * @property Cliente[] $clientes
 * @property Sucursal[] $sucursals
 */
class Lugar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lugar';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'lu_clave';

    /**
     * @var array
     */
    protected $fillable = ['fk_lugar', 'lu_tipo', 'lu_nombre'];

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
    public function cliente()
    {
        return $this->hasMany('App\Cliente', 'fk_lugar', 'lu_clave');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sucursal()
    {
        return $this->hasMany('App\Sucursal', 'fk_lugar', 'lu_clave');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
/**
 * @property int $cli_clave
 * @property int $fk_lugar
 * @property string $cli_cedula
 * @property string $cli_nombre
 * @property string $cli_apellido
 * @property string $cli_estado_civil
 * @property string $cli_empresa_trabajo
 * @property string $cli_fecha_nacimiento
 * @property boolean $cli_vip
 * @property string $cli_nacionalidad
 * @property Lugar $lugar
 * @property SucursalCliente[] $sucursalClientes
 */
class Cliente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cliente';
    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cli_clave';

    /**
     * @var array
     */
    protected $fillable = ['fk_lugar', 'cli_cedula', 'cli_nombre', 'cli_apellido', 'cli_estado_civil', 'cli_empresa_trabajo', 'cli_fecha_nacimiento', 'cli_vip', 'cli_nacionalidad'];

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
    public function sucursalClientes()
    {
        return $this->hasMany('App\SucursalCliente', 'fk_cliente', 'cli_clave');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $u_id
 * @property int $fk_rol
 * @property string $u_nombre
 * @property string $u_contraseña
 * @property int $fk_empleado
 * @property Rol $rol
 * @property Accion[] $accions
 */
class Usuario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuario';

    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'u_id';

    /**
     * @var array
     */
    protected $fillable = ['fk_rol', 'u_nombre', 'u_contraseña', 'fk_empleado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'fk_rol', 'rol_clave');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accions()
    {
        return $this->hasMany('App\Accion', 'fk_usuario', 'u_id');
    }
}

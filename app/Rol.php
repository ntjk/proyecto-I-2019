<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rol_clave
 * @property string $rol_nombre
 * @property string $rol_descripcion
 * @property Usuario[] $usuarios
 */
class Rol extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rol';
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'rol_clave';

    /**
     * @var array
     */
    protected $fillable = ['rol_nombre', 'rol_descripcion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'fk_rol', 'rol_clave');
    }
}

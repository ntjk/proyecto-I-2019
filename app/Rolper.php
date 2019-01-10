<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int fk_rol
 * @property int fk_permiso
 */
class Rolper extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rol_permiso';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'fk_rol';

    /**
     * @var array
     */
    protected $fillable = ['fk_permiso', 'fk_rol'];

   
    public function rol()
    {
        return $this->belongsTo('App\Rol', 'fk_rol', 'rol_clave');
    }
    public function permiso()
    {
        return $this->belongsTo('App\Permiso', 'fk_permiso', 'per_clave');
    }
}
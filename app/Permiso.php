<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $per_clave
 * @property string $per_nombre
* @property string $per_descripcion
 * @property string $per_tipo
 */
class Permiso extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permiso';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'per_clave';

    /**
     * @var array
     */
    protected $fillable = ['per_nombre', 'per_tipo', 'per_descripcion'];

   
    /*public function lugar()
    {
        return $this->belongsTo('App\Lugar', 'fk_lugar', 'lu_clave');
    }*/
    public function rolpers()
    {
        return $this->hasMany('App\Rolper', 'fk_permiso', 'per_clave');
    }
}

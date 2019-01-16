<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $ac_clave
 * @property string $ac_fecha
 * @property string $ac_descripcion
 * @property int fk_usuario
 */


class Accion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accion';
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ac_clave';

    /**
     * @var array
     */
    protected $fillable = ['ac_fecha', 'ac_descripcion', 'fk_usuario'];

    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'fk_usuario', 'u_id');
    }
}

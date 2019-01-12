<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $che_clave
 * @property string $che_estatus
 * @property string $che_descripcion
 * @property string $che_fecha_entrada
 * @property string $che_fecha_salida
 * @property int $fk_zona
 * @property int $fk_sucursal
 * @property int $fk_envio
 */
class Chequeo extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chequeo';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'che_clave';

    /**
     * @var array
     */
    protected $fillable = ['che_estatus', 'che_descripcion', 'che_fecha_entrada', 'che_fecha_salida', 'fk_zona', 'fk_envio', 'fk_sucursal'];

}

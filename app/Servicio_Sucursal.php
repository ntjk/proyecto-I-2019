<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $fk_servicio
 * @property int $fk_sucursal
 */
class Servicio_Sucursal extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'servicio_sucursal';
    public $timestamps = false;

    /**
     * @var array
     */
    //protected $fillable = ['fk_servicio','fk_sucursal'];
    protected $fillable = ['fk_servicio','fk_sucursal'];

}

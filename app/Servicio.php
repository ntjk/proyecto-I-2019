<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ser_clave
 * @property string $ser_tipo
 * @property string $ser_descripcion
 */
class Servicio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'servicio';
    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ser_clave';

    /**
     * @var array
     */
    protected $fillable = ['ser_tipo', 'ser_descripcion'];

}

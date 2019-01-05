<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $ti_clave
 * @property string $ti_nombre
 * @property float $ti_precio
 */
class Tipo extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipo';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ti_clave';

    /**
     * @var array
     */
    protected $fillable = ['ti_precio',  'ti_nombre'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $des_clave
 * @property string $des_cedula
 * @property string $des_nombre
 * @property string $des_apellido
 */
class Destinatario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'destinatario';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'des_clave';

    /**
     * @var array
     */
    protected $fillable = ['des_clave','des_apellido', 'des_nombre', 'des_cedula'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $rev_clave
 * @property float $rev_monto_pagar
 * @property string $rev_fecha_entrada
 * @property string $rev_fecha_prevista_salida
 * @property string $rev_fecha_real_salida
 * @property string $rev_fecha_proxima_revision
 * @property int $fk_taller
 * @property int $fk_flota
 */
class Revision extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'revision';
    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'rev_clave';

    /**
     * @var array
     */
    protected $fillable = ['rev_monto_pagar', 'rev_fecha_entrada', 'rev_fecha_prevista_salida', 'rev_fecha_real_salida', 'rev_fecha_proxima_revision', 'fk_taller', 'fk_flota'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'telefono';
    public $timestamps = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tel_clave';

    /**
     * @var array
     */
    protected $fillable = ['tel_numero', 'fk_cliente', 'fk_taller', 'fk_empleado', 'fk_sucursal', 'fk_destinatario'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinatario()
    {
        return $this->belongsTo('App\Destinatario', 'fk_destinatario', 'des_clave');
    }
}

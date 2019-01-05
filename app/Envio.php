<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int $en_clave
 * @property int $fk_sucursal_origen
 * @property int $fk_sucursal_destino
 * @property int $fk_cliente
 * @property int $fk_flota_ruta_1
 * @property int $fk_destinatario
 * @property string $en_tipo
 * @property float $en_precio
 * @property float $en_peso
 * @property string $en_descripcion
 * @property float $en_altura
 * @property float $en_anchura
 * @property float $en_profundidad
 * @property string $en_fecha_envio
 * @property string $en_fecha_entrega_estimada
 //* @property Destinatario $destinatario
 //* @property Pago[] $pagos
 */
class Envio extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'envio';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'en_clave';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['en_tipo', 'en_precio', 'en_peso', 'en_descripcion', 'en_anchura', 'en_altura', 'en_profundidad', 'en_fecha_envio', 'en_fecha_entrega_estimada', 'fk_sucursal_origen', 'fk_cliente', 'fk_destinatario', 'fk_flota_ruta_1', 'fk_sucursal_destino'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sucursalOrigen(){
        return $this->belongsTo('App\Sucursal')->where('fk_sucursal_origen', 'su_clave');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sucursalDestino(){
        return $this->belongsTo('App\Sucursal')->where('fk_sucursal_destino', 'su_clave');
    }
    /*$envios = $sucursal->load('sucursalOrigen','sucursalDestino');
    @foreach($envios as $envio)

        {{ $envio->otherTeam()->name; }}

    @endforeach*/
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'fk_cliente', 'cli_clave');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function floru()
    {
        return $this->belongsTo('App\Floru', 'fk_flota_ruta_1', 'flo_ru_clave');
    }
   
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $flo_clave
 * @property int $fk_sucursal
 * @property int $fk_modelo
 * @property string $flo_subtipo
 * @property string $flo_tipo
 * @property float $flo_peso
 * @property string $flo_placa
 * @property string $flo_descripcion
 * @property float $flo_combustible_por_hora
 * @property string $flo_serial_carroceria
 * @property float $flo_capacidad_carga
 * @property boolean $flo_te_nacional
 * @property string $flo_te_serial_motor
 * @property string $flo_ma_serial_motor
 * @property float $flo_a_longitud
 * @property float $flo_a_envergadura
 * @property float $flo_a_area
 * @property float $flo_a_altura
 * @property float $flo_a_ancho_cabina_interna
 * @property float $flo_a_diametro_fuselaje
 * @property float $flo_a_peso_vacio
 * @property float $flo_a_peso_maximo_despegue
 * @property float $flo_a_carrera_de_despegue
 * @property float $flo_a_velocidad_maxima
 * @property int $flo_año
 * @property Modelo $modelo
 * @property Sucursal $sucursal
 * @property Puerto[] $puertos
 * @property FlotaRutum[] $flotaRutas
 * @property AereaAeropuerto[] $aereaAeropuertos
 */
class Flota extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flota';
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'flo_clave';

    /**
     * @var array
     */
    protected $fillable = ['fk_sucursal', 'fk_modelo', 'flo_subtipo', 'flo_tipo', 'flo_peso', 'flo_placa', 'flo_descripcion',
     'flo_combustible_por_hora', 'flo_serial_carroceria', 'flo_capacidad_carga', 'flo_te_nacional', 'flo_te_serial_motor',
     'flo_ma_serial_motor', 'flo_a_longitud', 'flo_a_envergadura', 'flo_a_area', 'flo_a_altura', 'flo_a_ancho_cabina_interna',
     'flo_a_diametro_fuselaje', 'flo_a_peso_vacio', 'flo_a_peso_maximo_despegue', 'flo_a_carrera_de_despegue', 'flo_a_velocidad_maxima',
     'flo_año'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modelo()
    {
        return $this->belongsTo('App\Modelo', 'fk_modelo', 'mod_clave');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sucursal()
    {
        return $this->belongsTo('App\Sucursal', 'fk_sucursal', 'su_clave');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function puertos()
    {
        return $this->hasMany('App\Puerto', 'fk_flota', 'flo_clave');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flotaRutas()
    {
        return $this->hasMany('App\FlotaRutum', 'fk_flota', 'flo_clave');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aereaAeropuertos()
    {
        return $this->hasMany('App\AereaAeropuerto', 'fk_flota', 'flo_clave');
    }

   
    /*
    Once the relationship is defined, you may access the flota's rutas using the rutas dynamic property:

$flota = App\Flota::find(1);

foreach ($flota->rutas as $ruta) {
    //
}
Of course, like all other relationship types, you may call the rutas method to continue chaining query constraints onto the relationship:

$rutas = App\Flota::find(1)->rutas()->orderBy('___')->get();

    */
}


// <th>Nacional</th>
// <th>Serial motor</th>

// <th>Serial motor</th>

// <th>Longitud</th>
// <th>Envergadura</th>
// <th>Área</th>
// <th>Altura</th>
// <th>Ancho de cabina interna</th>
// <th>Diámetro de fusilaje</th>
// <th>Peso vacío</th>
// <th>Peso máximo de despegue</th>
// <th>Carrera de despegue</th>
// <th>Velocidad máxima</th>

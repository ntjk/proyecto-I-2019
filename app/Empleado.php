<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $em_clave
 * @property string $em_cedula
 * @property string $em_nombre
 * @property string $em_apellido
 * @property string $em_profesion
 * @property string $em_estado_civil
 * @property float $em_salario_base
 * @property string $em_email_empresa
 * @property string $em_email_personal
 * @property string $em_nivel_academico
 * @property integer $em_cantidad_hijos
 * @property string $em_descripcion_trabajo
 * @property string $em_fecha_egreso
 * @property string $em_fecha_ingreso
 * @property string $em_fecha_nacimiento
 * @property int $fk_lugar
 * @property string $em_nacionalidad
 * @property ZonaEmpleado[] $zonaEmpleados
 */
class Empleado extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empleado';
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'em_clave';

    /**
     * @var array
     */
    protected $fillable = ['em_cedula', 'em_nombre', 'em_apellido', 'em_profesion', 'em_estado_civil', 'em_salario_base', 'em_email_empresa', 'em_email_personal', 'em_nivel_academico', 'em_cantidad_hijos', 'em_descripcion_trabajo', 'em_fecha_egreso', 'em_fecha_ingreso', 'em_fecha_nacimiento', 'fk_lugar', 'em_nacionalidad'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zonaEmpleados()
    {
        return $this->hasMany('App\ZonaEmpleado', 'fk_empleado', 'em_clave');
    }
}

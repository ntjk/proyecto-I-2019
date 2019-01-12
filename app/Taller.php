<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//Nota: Truncate tabla Taller para reset la secuenciade claves

/**
 * @property int $ta_clave
 * @property string $ta_nombre
 * @property string $ta_email
 * @property string $ta_contacto
 * @property string $ta_pagina_web
 * @property int $fk_lugar
 */
class Taller extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'taller';
    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ta_clave';

    /**
     * @var array
     */
    protected $fillable = ['ta_nombre', 'ta_email', 'ta_contacto', 'ta_pagina_web', 'fk_lugar'];

}

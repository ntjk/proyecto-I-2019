<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $fa_clave
 * @property string $fa_descripcion
 * @property int $fk_revision_1
 * @property int $fk_revision_2
 * @property int $fk_revision_3
 */
class Falla extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'falla';
    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'fa_clave';

    /**
     * @var array
     */
    protected $fillable = ['fa_descripcion', 'fk_revision_1', 'fk_revision_2', 'fk_revision_3'];

}

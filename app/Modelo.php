<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $mod_clave
 * @property int $fk_marca
 * @property string $mod_nombre
 * @property Marca $marca
 * @property Flotum[] $flotas
 */
class Modelo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'modelo';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'mod_clave';

    /**
     * @var array
     */
    protected $fillable = ['fk_marca', 'mod_nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marca()
    {
        return $this->belongsTo('App\Marca', 'fk_marca', 'mar_clave');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flotas()
    {
        return $this->hasMany('App\Flotum', 'fk_modelo', 'mod_clave');
    }
}

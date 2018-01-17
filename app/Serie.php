<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cantidad_series', 'peso_corporal', 'peso_externo', 'masa', 'potencia_impulsiva',
        'potencia_relativa', 'velocidad_impulsiva', 'fuerza_impulsiva',
        'cantidad_repeticiones', 'mejor_serie', 'rm','mejor_serie','ultima_serie',
        'pse','rm_pse_porcentual','rm_porcentual','mejor_serie_boolean',
    ];

    protected $dates = ['deleted_at'];

    public function clientes(){
        return $this->belongsToMany('App\Cliente','clientes_series','serie_id','cliente_id')->withTimestamps();
    }
}

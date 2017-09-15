<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluaciones extends Model
{
    use SoftDeletes;

    public $table = 'evaluaciones';

    protected $fillable = [
        'maximo_peso', 'velocidad_segundos', 'salto_abalacob', 'salto_cmj', 'salto_sj',
        'mejor_salto_continuo', 'peor_salto_continuo', 'cantidad_salto_continuo',
        'resistencia_numero_fase', 'cantidad_repeticiones',
    ];

    protected $dates = ['deleted_at'];

    public function clientes(){
        return $this->belongsToMany('App\Cliente','clientes_evaluaciones','evaluaciones_id','cliente_id')->withTimestamps();
    }

    public function ejercicios(){
        return $this->belongsToMany('App\Ejercicios','clientes_evaluaciones','evaluaciones_id','ejercicio_id')->withTimestamps();
    }
}

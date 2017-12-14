<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicador extends Model
{
    public $table = 'indicadores';
    use SoftDeletes;

    protected $fillable = [
        'cliente_id', 'fecha_indicador', 'semana', 'peso_inicial', 'peso_final', 'diferencia_peso_porcentual',
        'hora_entrada', 'hora_salida', 'pse', 'sueno', 'dolor', 'deseo_entrenar', 'desayuno', 'sumatoria',
        'pse_global_sesion', 'tiempo_entrenamiento', 'carga_entrenamiento',
    ];
    protected $dates = ['deleted_at'];



    //Indicamos que un cliente tiene muchos indicadores
    public function clientes(){
        //return $this->belongsTo(Cliente::class);
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
        //return $this->belongsTo('App\Cliente', 'cliente_id', 'id');

    }

//    //Indicamos que un indicador_Semanal tiene muchos indicadores
//    public function indicadores_semanales() {
//        return $this->hasMany(IndicadorSemanal::class); // this matches the Eloquent model
//    }

}

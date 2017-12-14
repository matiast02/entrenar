<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'dias_semana', 'grupo', 'costo_mensual',
    ];


    protected $dates = ['deleted_at'];


//    //El pago o mensualidad tendrá muchos usuarios
    public function clientes(){
        return $this->belongsToMany('App\Cliente','clientes_pagos','pago_id','cliente_id')
            ->withPivot('cliente_id', 'pago_id', 'fecha_pago', 'mes_pago', 'created_at','updated_at')->withTimestamps();
    }
}

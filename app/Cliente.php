<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre', 'apellido', 'fecha_nacimiento', 'dni', 'direccion', 'celular', 'email', 'deporte_id',
        'categoria', 'institucion', 'gym', 'fecha_inicio_entrenamiento', 'foto', 'test_control_id', 'estado',
    ];


    protected $dates = ['deleted_at'];


    public function series(){
        return $this->belongsToMany('App\Serie','clientes_series','cliente_id','serie_id')
            ->withPivot('cliente_id', 'serie_id', 'ejercicio_id')->withTimestamps();
    }

    public function evaluaciones(){
        return $this->belongsToMany('App\Evaluaciones','clientes_evaluaciones','cliente_id','evaluaciones_id')
            ->withPivot('cliente_id', 'evaluaciones_id', 'ejercicio_id')->withTimestamps();
    }


    public function pagos(){
        return $this->belongsToMany('App\Pago','clientes_pagos','cliente_id','pago_id')
            ->withPivot('fecha_pago', 'mes_pago', 'created_at','updated_at')->withTimestamps();
    }

    public function ejercicios(){
        return $this->belongsToMany('App\Ejercicio','clientes_ejercicios','cliente_id','ejercicio_id')->withTimestamps();
    }


    //Uno a Muchos
    //Indicamos que un cliente pertenece a un deporte
    public function deportes() {
        return $this->belongsTo('App\Deporte','deporte_id'); // this matches the Eloquent model
    }

    //Indicamos que un cliente pertenece a una categoria
    public function categorias() {
        return $this->belongsTo('App\Categoria','categoria_id'); // this matches the Eloquent model
    }

    //Indicamos que un cliente tiene muchos indicadores
    public function indicadores() {
        //return $this->hasMany(Indicador::class); // this matches the Eloquent model
        return $this->hasMany(Indicador::class);
    }

    public function antropometrias(){
        return $this->hasMany(Antropometria::class);
    }


}

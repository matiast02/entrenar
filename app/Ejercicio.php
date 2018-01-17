<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ejercicio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre', 'categoria_ejercicios_id', 'fuerza'
    ];

    protected $dates = ['deleted_at'];

    // definimos la tabla pivote
    public function clientes(){
        return $this->belongsToMany('App\Cliente','clientes_ejercicios','ejercicio_id','cliente_id')->withTimestamps();
    }

    //Indicamos que una categoria_ejercicios tiene muchos ejercicios
    public function categoria_ejercicios() {
        return $this->hasMany(Categoria_Ejercicio::class);

    }
}

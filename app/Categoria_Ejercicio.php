<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria_Ejercicio extends Model
{
    use SoftDeletes;

    public $table = 'categoria_ejercicios';

    protected $fillable = [
        'nombre',
    ];

    protected $dates = ['deleted_at'];

    //Indicamos que una categoria de ejercicio puede Tener muchos ejercicios
    public function ejercicios(){
        return $this->hasMany(Ejercicio::class);
    }
}

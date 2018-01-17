<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
    ];

    protected $dates = ['deleted_at'];

    //Indicamos que un deporte puede ser realizado por muchos clientes
    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

    //return $this->hasMany('App\Cliente','categoria_id','id');

}

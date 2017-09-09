<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antropometria extends Model
{
    use SoftDeletes;

    public $table = 'antropometrias';

    protected $fillable = [
        'cliente_id', 'fecha_antropometria', 'peso_corporal', 'talla', 'porcentaje_adiposo', 'porcentaje_muscular',
        'indice_endo', 'indice_meso', 'indice_hecto', 'clasificacion', 'ideal',
    ];

    protected $dates = ['deleted_at'];


    public function clientes(){
        return $this->belongsTo('App\Cliente','cliente_id', 'id');
    }


}

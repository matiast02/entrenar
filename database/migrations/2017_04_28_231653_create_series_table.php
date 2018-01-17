<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{


    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad_series');
            $table->float('peso_corporal');
            $table->float('peso_externo');

            $table->float('masa');//Aca va Masa, que es una suma de peso externo con peso corporal

            $table->float('potencia_impulsiva');

            $table->float('potencia_relativa');//Acá va potencia Relativa = P.Impulsiva/Peso Corporal

            $table->float('velocidad_impulsiva');
            $table->float('fuerza_impulsiva');

            $table->integer('cantidad_repeticiones');
            $table->integer('mejor_serie');
            $table->float('rm');

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('series');
    }
}

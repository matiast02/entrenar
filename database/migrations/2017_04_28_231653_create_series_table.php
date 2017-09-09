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
            $table->integer('peso_corporal');
            $table->integer('peso_externo');

            $table->integer('masa');//Aca va Masa, que es una suma de peso externo con peso corporal

            $table->integer('potencia_impulsiva');

            $table->float('potencia_relativa');//Acá va potencia Relativa = P.Impulsiva/Peso Corporal

            $table->integer('velocidad_impulsiva');
            $table->integer('fuerza_impulsiva');

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

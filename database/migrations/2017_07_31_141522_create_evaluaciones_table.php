<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesTable extends Migration
{


    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('maximo_peso'); //MAXIMO PESO (Peso Externo): Peso Muerto, Remo y Sentadilla Bulgara
            $table->string('velocidad_segundos'); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Velocidad 10 Mts.
            $table->string('salto_abalacob');//MAXIMO SALTO (ALTURA) EN MTS: Salto Abalacob, cmj y sj.
            $table->string('salto_cmj');//MAXIMO SALTO (ALTURA) EN MTS: Salto cmj.
            $table->string('salto_sj');//MAXIMO SALTO (ALTURA) EN MTS: Salto sj.
            $table->string('mejor_salto_continuo');//MEJOR SALTO (De una serie de saltos, anota el mejor)
            $table->string('peor_salto_continuo');//PEOR SALTO (De una serie de saltos, anota el peor)
            $table->string('cantidad_salto_continuo');//CANTIDAD SALTO (De una serie de saltos, anota la cantidad de saltos)
            $table->integer('resistencia_numero_fase');//YOYO TEST RESISTENCIA: Numero de fase en la que termina.
            $table->integer('cantidad_repeticiones')->nullable();//SENTADILLA BULGARA: Cantidad de repeticiones.

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('evaluaciones');
    }


}

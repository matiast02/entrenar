<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEvaluacionesTableAddNullableAllCol extends Migration
{


    public function up()
    {
        Schema::table('evaluaciones', function (Blueprint $table) {
            $table->float('maximo_peso')->nullable()->change(); //MAXIMO PESO (Peso Externo): Peso Muerto, Peso Muerto 1 pierna y Remo
            $table->renameColumn('velocidad_segundos', 'velocidad_segundos_10'); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Velocidad 10 Mts Y Agilidad 10.
            $table->float('velocidad_decimas_10')->nullable(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Velocidad 10 Mts Y Agilidad 10.
            $table->float('velocidad_centesimas_10')->nullable(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Velocidad 10 Mts Y Agilidad 10.
            $table->float('salto_abalakov')->nullable()->change();//MAXIMO SALTO (ALTURA) EN MTS: Salto Abalakov, cmj y sj.
            $table->float('salto_cmj')->nullable()->change();//MAXIMO SALTO (ALTURA) EN MTS: Salto cmj.
            $table->float('salto_sj')->nullable()->change();//MAXIMO SALTO (ALTURA) EN MTS: Salto sj.
            $table->float('mejor_salto_continuo')->nullable()->change();//MEJOR SALTO (De una serie de saltos, anota el mejor)
            $table->float('peor_salto_continuo')->nullable()->change();//PEOR SALTO (De una serie de saltos, anota el peor)
            $table->integer('cantidad_salto_continuo')->nullable()->change();//CANTIDAD SALTO (De una serie de saltos, anota la cantidad de saltos)
            $table->integer('resistencia_numero_fase')->nullable()->change();//YOYO TEST RESISTENCIA: Numero de fase en la que termina.
            $table->float('velocidad_segundos_5')->nullable();//TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Agilidad 5.
            $table->float('velocidad_decimas_5')->nullable(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Agilidad 5.
            $table->float('velocidad_centesimas_5')->nullable(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Agilidad 5.
            $table->float('velocidad_sumatoria')->nullable(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Agilidad Sumatoria.

        });
    }



    public function down()
    {
        //
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEvaluacionesTableAddNullableAllCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluaciones', function (Blueprint $table) {
            $table->integer('maximo_peso')->nullable()->change(); //MAXIMO PESO (Peso Externo): Peso Muerto y Remo
            $table->string('velocidad_segundos')->nullable()->change(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Velocidad 10 Mts.
            $table->string('velocidad_decimas')->nullable(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Velocidad 10 Mts.
            $table->string('velocidad_centesimas')->nullable(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Velocidad 10 Mts.
            $table->string('salto_abalacob')->nullable()->change();//MAXIMO SALTO (ALTURA) EN MTS: Salto Abalacob, cmj y sj.
            $table->string('salto_cmj')->nullable()->change();//MAXIMO SALTO (ALTURA) EN MTS: Salto cmj.
            $table->string('salto_sj')->nullable()->change();//MAXIMO SALTO (ALTURA) EN MTS: Salto sj.
            $table->string('mejor_salto_continuo')->nullable()->change();//MEJOR SALTO (De una serie de saltos, anota el mejor)
            $table->string('peor_salto_continuo')->nullable()->change();//PEOR SALTO (De una serie de saltos, anota el peor)
            $table->string('cantidad_salto_continuo')->nullable()->change();//CANTIDAD SALTO (De una serie de saltos, anota la cantidad de saltos)
            $table->integer('resistencia_numero_fase')->nullable()->change();//YOYO TEST RESISTENCIA: Numero de fase en la que termina.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

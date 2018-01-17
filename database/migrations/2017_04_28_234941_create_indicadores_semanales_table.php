<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadoresSemanalesTable extends Migration
{


    public function up()
    {
        Schema::create('indicadores_semanales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indicador_id')->unsigned();
            $table->foreign('indicador_id')->references('id')->on('indicadores');

            $table->float('carga_semanal');
            $table->float('ds');
            $table->float('indice_monotonia');
            $table->float('impacto');

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('indicadores_semanales');
    }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntropometriasTable extends Migration
{


    public function up()
    {
        Schema::create('antropometrias', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->date('fecha_antropometria');
            
            $table->float('peso_corporal');
            $table->float('talla');
            $table->float('porcentaje_adiposo');
            $table->float('porcentaje_muscular');
            $table->float('indice_endo');
            $table->float('indice_meso');
            $table->float('indice_hecto');
            $table->string('clasificacion');
            $table->string('ideal');

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('antropometrias');
    }
}

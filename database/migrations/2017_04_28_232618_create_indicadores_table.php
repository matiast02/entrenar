<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadoresTable extends Migration
{


    public function up()
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            //$table->foreign('cliente_id')->references('id')->on('clientes');
            $table->date('fecha_indicador');

            $table->integer('semana'); //Numero de semana a la que corresponde dicha fecha
            $table->date('mes'); //Mes

            $table->float('peso_inicial');
            $table->float('peso_final');
            $table->float('diferencia_peso_porcentual');

            $table->time('hora_entrada');
            $table->time('hora_salida');

            $table->integer('pse');
            $table->integer('sueno');
            $table->integer('dolor');
            $table->integer('deseo_entrenar');
            $table->integer('desayuno');
            $table->integer('sumatoria'); //Suma de pse, sueno, dolor, deseo_entrenar y desayuno

            $table->integer('pse_global_sesion');
            $table->float('tiempo_entrenamiento'); //Debe dar el resultado en minutos
            $table->integer('carga_entrenamiento');

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('indicadores');
    }
}

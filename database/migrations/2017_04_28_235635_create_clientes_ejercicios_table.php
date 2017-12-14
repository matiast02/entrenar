<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesEjerciciosTable extends Migration
{


    public function up()
    {
        Schema::create('clientes_ejercicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->integer('ejercicio_id')->unsigned();
            $table->foreign('ejercicio_id')->references('id')->on('ejercicios');

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('clientes_ejercicios');
    }
}

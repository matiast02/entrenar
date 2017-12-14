<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesPagosTable extends Migration
{


    public function up()
    {
        Schema::create('clientes_pagos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->integer('pago_id')->unsigned();
            $table->foreign('pago_id')->references('id')->on('pagos');

            $table->date('fecha_pago');

            $table->date('mes_pago');

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('clientes_pagos');
    }
}

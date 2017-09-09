<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{


    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->string('dni');
            $table->string('direccion');
            $table->string('celular');
            $table->string('email');

            $table->integer('deporte_id')->unsigned();
            //$table->foreign('deporte_id')->references('id')->on('deportes');

            $table->integer('categoria_id')->unsigned();
            //$table->foreign('categoria_id')->references('id')->on('categorias');

            $table->string('institucion');
            $table->string('gym');
            $table->date('fecha_inicio_entrenamiento');
            $table->string('foto')->nullable();

            $table->integer('test_control_id')->unsigned();

            $table->boolean('estado');
            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('clientes');
    }
}

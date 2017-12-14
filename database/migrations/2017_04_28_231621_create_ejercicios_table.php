<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEjerciciosTable extends Migration
{


    public function up()
    {
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

            $table->integer('categoria_ejercicios_id')->unsigned();

            $table->boolean('fuerza');

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('ejercicios');
    }
}

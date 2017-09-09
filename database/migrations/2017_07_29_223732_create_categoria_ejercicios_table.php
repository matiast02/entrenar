<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaEjerciciosTable extends Migration
{


    public function up()
    {
        Schema::create('categoria_ejercicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

            $table->softDeletes();
            $table->timestamps();

        });
    }



    public function down()
    {
        Schema::drop('categoria_ejercicios');
    }

}

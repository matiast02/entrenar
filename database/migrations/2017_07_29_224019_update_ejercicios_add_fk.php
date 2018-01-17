<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEjerciciosAddFk extends Migration
{


    public function up()
    {
        Schema::table('ejercicios', function ($table) {

            $table->foreign('categoria_ejercicios_id')->references('id')->on('categoria_ejercicios');

        });
    }



    public function down()
    {
        //
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeportesTable extends Migration
{


    public function up()
    {
        Schema::create('deportes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::drop('deportes');
    }
}

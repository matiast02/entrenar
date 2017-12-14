<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClienteTableAddFk extends Migration
{


    public function up()
    {
        Schema::table('clientes', function ($table) {

            $table->foreign('deporte_id')
                ->references('id')->on('deportes');

        });
    }



    public function down()
    {
        //
    }
}

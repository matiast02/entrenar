<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateIndicadoresTableAddFk extends Migration
{


    public function up()
    {
        Schema::table('indicadores', function ($table) {
            $table->foreign('cliente_id')
                ->references('id')->on('clientes');

        });
    }


    public function down()
    {
        //
    }
}

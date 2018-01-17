<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientesTableCategoriasAddFk extends Migration
{


    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {

            $table->foreign('categoria_id')
                ->references('id')->on('categorias');

        });
    }



    public function down()
    {

    }
}

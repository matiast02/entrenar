<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableEvaluacionesColSumatoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluaciones', function (Blueprint $table) {
            //cambiar el tipo de float a string
            $table->string('velocidad_sumatoria')->change(); //TIEMPO EN SEGUNDOS, DECIMAS Y SENTESIMAS: Agilidad Sumatoria.

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

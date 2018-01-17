<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSoftdeletesUsersTable extends Migration
{


    public function up()
    {
        Schema::table('users', function ($table) {
            $table->softDeletes();
        });
    }



    public function down()
    {
        //
    }
}

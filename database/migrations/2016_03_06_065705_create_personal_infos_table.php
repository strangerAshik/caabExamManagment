<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id');

            $table->string('father_name');
            $table->string('mother_name');
            $table->string('date_of_birth');
            $table->string('nationality');
            $table->string('passport_no');
            $table->string('validity_date');
            $table->string('parmanent_address',1000);
            $table->string('mailing_address',1000);
            $table->string('gender');
            

            $table->string('creator');
            $table->string('updater');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personal_infos');
    }
}

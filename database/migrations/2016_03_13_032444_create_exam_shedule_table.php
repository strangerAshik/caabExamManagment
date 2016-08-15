<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamSheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_shedules', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('title');
            $table->string('licence_type');
            $table->string('subject');
            $table->string('exam_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('total_question');
            $table->longText('note');    

            $table->string('creator');
            $table->string('updater');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exam_shedules');
    }
}

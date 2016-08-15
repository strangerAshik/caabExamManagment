<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionGeneratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_generators', function (Blueprint $table) {
            $table->increments('id');
           
            $table->string('exam_id');
            $table->string('chapter_id');
            $table->integer('difficulty_level');
            $table->integer('question_no');
            $table->integer('avoid_last');


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
        Schema::drop('question_generators');
    }
}

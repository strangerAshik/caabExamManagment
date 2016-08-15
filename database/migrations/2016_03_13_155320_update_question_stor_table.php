<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuestionStorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_stors', function (Blueprint $table) {
            $table->integer('question_id')->after('question_generator_id');
            $table->integer('exam_id')->after('id');
            $table->integer('chapter_id')->after('question');

             $table->integer('licence_type_id')->after('id');
            $table->integer('subject_id')->after('licence_type_id');
            $table->integer('difficulty_level_id')->after('subject_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_stors', function (Blueprint $table) {
            //
        });
    }
}

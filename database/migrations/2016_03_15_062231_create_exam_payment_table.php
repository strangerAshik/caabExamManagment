<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_payments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('exam_id');
            $table->integer('user_id');
            $table->string('fee_type');
            $table->string('doc_number');
            $table->string('bank');
            $table->string('branch');
            $table->string('account_name');
            
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
        Schema::drop('exam_payments');
    }
}

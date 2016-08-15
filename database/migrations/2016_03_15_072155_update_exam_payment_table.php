<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateExamPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_payments', function (Blueprint $table) {
            $table->string('status')->after('account_name');
            $table->string('note',1000)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_payments', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('note');
        });
    }
}

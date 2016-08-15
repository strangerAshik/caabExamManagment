<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_details', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id');
            
            $table->string('first_training_date');
            $table->string('defense_personnel');
            $table->string('defence_category');
            $table->string('having_spl_or_not');
            $table->string('date_of_issue_of_spl');
            $table->string('higher_category_pilot_license');
            $table->string('license_category');
            $table->string('license_number');
            $table->string('license_validity');
            $table->string('endorsement_of_multi_engine_aircraft');
            $table->string('total_flying_hour');
            $table->string('total_flying_hour_as_pilot_in_command');
            $table->string('flying_training_institute');
            $table->string('ground_training_institute');


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
        Schema::drop('professional_details');
    }
}

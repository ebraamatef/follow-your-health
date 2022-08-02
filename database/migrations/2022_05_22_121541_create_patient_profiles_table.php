<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->enum('exercise',array('sedentary ','mild exercise','occasional vigorous','Regular'))->nullable();

            $table->enum('dieting',array('yes ','no'))->nullable();
            $table->enum('medical_diet',array('yes ','no'))->nullable();
            
            $table->string('meals_average')->nullable();
            
            
            $table->enum('Rank_salt',array('high','medium','low'))->nullable();
            
            $table->enum('caffeine',array('none ','coffee','tea','cola'))->nullable();
            $table->string('cups')->nullable();

            // ---------------------------------------------------
            $table->enum('alchohol',array('yes ','no'))->nullable();
            $table->string('alchohol_kind')->nullable();
            $table->string('alchohol_rate')->nullable();
            $table->enum('alchohol_concerned',array('yes ','no'))->nullable();
            $table->enum('alchohol_stopping',array('yes ','no'))->nullable();
            $table->enum('alchohol_binge',array('yes ','no'))->nullable();
            $table->enum('alchohol_drive',array('yes ','no'))->nullable();
            // ------------------------------------------------------------
            $table->enum('use_tobacco',array('yes ','no'))->nullable();
            // --------------------------------------------------------
            $table->enum('use_drugs',array('yes ','no'))->nullable();
            $table->enum('drug_needle',array('yes ','no'))->nullable();
            // -------------------------------------------------------
            $table->enum('sexually_active',array('yes ','no'))->nullable();
            $table->enum('sexually_pregnancy',array('yes ','no'))->nullable();
            $table->enum('sexually_discomfort',array('yes ','no'))->nullable();
             // -------------------------------------------------------

             $table->enum('live_alone',array('yes ','no'))->nullable();
             $table->enum('frequent_falls',array('yes ','no'))->nullable();
             $table->enum('vision_hearing_loss',array('yes ','no'))->nullable();

              // -------------------------------------------------------

              $table->enum('stress',array('yes ','no'))->nullable();
              $table->enum('depressed',array('yes ','no'))->nullable();
              $table->enum('panic',array('yes ','no'))->nullable();
              $table->enum('appetite',array('yes ','no'))->nullable();
              $table->enum('cry_frequently',array('yes ','no'))->nullable();
              $table->enum('suicide',array('yes ','no'))->nullable();
              $table->enum('hurting_yourself',array('yes ','no'))->nullable();
              $table->enum('trouble_sleeping',array('yes ','no'))->nullable();
              $table->enum('counselor',array('yes ','no'))->nullable();

               // -------------------------------------------------------
             
                // -------------------------------------------------------
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
        Schema::dropIfExists('patient_profiles');
    }
};

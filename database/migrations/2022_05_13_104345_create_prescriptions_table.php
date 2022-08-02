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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('visit_id')->references('id')->on('visits')->onUpdate('cascade')
            ->onDelete('cascade')->nullable();

            $table->foreignId('patient_id')->references('id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('doctor_id')->references('id')->on('doctors')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->string("medication")->nullable();
            $table->string("doctor_name")->nullable();
            $table->string("instructions")->nullable();
            $table->string("start_date")->nullable();
            $table->string("end_date")->nullable();
            $table->enum('status',array('0','1'))->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
};

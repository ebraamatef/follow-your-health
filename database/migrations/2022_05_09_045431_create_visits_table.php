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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')->references('id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('doctor_id')->references('id')->on('doctors')->onUpdate('cascade');
            $table->string("doctor_name")->nullable();
            $table->string("specialty")->nullable();

            $table->string("patient_complaint")->nullable();
            $table->string("visit_report")->nullable();
            $table->string("treatment_action")->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('visits');
    }
};

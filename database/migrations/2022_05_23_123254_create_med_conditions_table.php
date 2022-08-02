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
        Schema::create('med_conditions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')->references('id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');


            $table->string('condition')->nullable();
            $table->string('doctor_name')->nullable();
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
        Schema::dropIfExists('med_conditions');
    }
};

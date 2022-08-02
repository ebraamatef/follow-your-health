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
        Schema::create('blood_sugar_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')->references('id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->time('time')->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('reading')->nullable();
            $table->enum("unit",array('mmol/L','mg/L'))->nullable();
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
        Schema::dropIfExists('blood_sugar_logs');
    }
};

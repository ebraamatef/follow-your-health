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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();


            $table->string("test", 255)->nullable();

            $table->string("doctor_name", 255)->nullable();
            $table->string("lab_name", 255)->nullable();
            $table->date('date', 255)->nullable();

            $table->string('file', 255)->nullable();
            $table->foreignId('patient_id')->references('id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('lab_id')->references('id')->on('labs')->onUpdate('cascade')
            ->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('tests');
    }
};

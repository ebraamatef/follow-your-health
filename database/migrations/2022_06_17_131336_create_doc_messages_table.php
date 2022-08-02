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
        Schema::create('doc_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->bigInteger('sender');
            $table->foreignId('patient_id')->references('id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreignId('doctor_id')->references('id')->on('doctors')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('doc_messages');
    }
};

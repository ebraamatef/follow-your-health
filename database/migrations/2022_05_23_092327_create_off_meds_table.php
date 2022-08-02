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
        Schema::create('off_meds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')->references('id')->on('patients')->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->string('medication')->nullable();
            $table->enum('status',array('Frequently','Occasionally','When needed', 'Stopped'))->nullable();
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
        Schema::dropIfExists('off_meds');
    }
};

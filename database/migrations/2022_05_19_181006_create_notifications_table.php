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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("sender_id")->nullable();
            $table->string("sender_type")->nullable();
            $table->string('sender_image','255')->nullable();
            $table->foreignId('reciever')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade')->nullable();
            $table->string("notification")->nullable();
            $table->string("link")->nullable();
            $table->enum('subject',array('request','test','radiology', 'prescription', 'allergy', 'condition', 'surgery'));
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
        Schema::dropIfExists('notifications');
    }
};

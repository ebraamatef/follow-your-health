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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');
            
            $table->string("name")->nullable();
            $table->bigInteger("national_id")->unique()->nullable();
            $table->bigInteger("alt_phone")->nullable();
            $table->bigInteger("phone")->unique()->nullable();
            $table->string("address")->nullable();
            $table->enum("smoker",array('yes','no'))->nullable();
            $table->enum('blood_type',array('A+','A-','B+','B-','AB+','AB-','O+','O-'))->nullable();
            $table->string('image','255')->nullable();
            $table->decimal("weight")->nullable();
            $table->decimal("height")->nullable();
            $table->date("date_of_birth")->nullable();
            $table->enum("marital",array('married','single'))->nullable();
            $table->enum("gender",array('male','fmale'))->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('patients');
    }
};

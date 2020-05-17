<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_ins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('myCash');
            $table->dateTime('date');
            $table->bigInteger('patient_ID')->unsigned()->nullable();
            $table->foreign('patient_ID')->references('id')->on('patients');
            $table->bigInteger('user_ID')->unsigned()->nullable();
            $table->foreign('user_ID')->references('id')->on('users');
            $table->string('notes')->nullable();
            $table->bigInteger('hospital_ID')->unsigned()->nullable();
            $table->foreign('hospital_ID')->references('id')->on('hospitals');
            $table->boolean('isExist');
            $table->boolean('Finished');
            $table->dateTime('datefinish')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visit_ins');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('Patient_ID')->unsigned();
            $table->foreign('Patient_ID')->references('id')->on('patients');
            $table->bigInteger('Service_ID')->unsigned();
            $table->foreign('Service_ID')->references('id')->on('services');
            $table->bigInteger('Wallet_ID')->unsigned();
            $table->foreign('Wallet_ID')->references('id')->on('wallets');
            $table->dateTime('date');
            $table->double('price');
            $table->integer('PrintingTimes');
            $table->boolean('done');
            $table->string('notes')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_details');
    }
}

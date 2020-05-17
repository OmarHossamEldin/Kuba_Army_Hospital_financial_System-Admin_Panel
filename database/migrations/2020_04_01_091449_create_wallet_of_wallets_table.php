<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletOfWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_of_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('totalMoney');
            $table->bigInteger('user_ID')->unsigned();
            $table->foreign('user_ID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_of_wallets');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('withdraw_amount');
            $table->string('withdraw_commission');
            $table->string('withdraw_tax')->nullable();
            $table->string('withdraw_charge')->nullable();
            $table->string('withdraw_method')->nullable();
            $table->string('withdraw_method_address')->nullable();
            $table->string('transaction_hash')->nullable();
            $table->string('withdraw_status')->nullable();
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
        Schema::dropIfExists('withdraws');
    }
}

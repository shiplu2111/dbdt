<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_settings', function (Blueprint $table) {
            $table->id();
            $table->string('pack_value_withdraw_status')->nullable();
            $table->string('commission_withdraw_status')->nullable();
            $table->string('withdraw_commission')->nullable();
            $table->string('withdraw_tax')->nullable();
            $table->string('withdraw_charge')->nullable();
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
        Schema::dropIfExists('withdraw_settings');
    }
}

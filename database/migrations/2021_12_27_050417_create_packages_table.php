<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('packagename');
            $table->float('usdtprice');
            $table->float('dbdtprice');
            $table->float('withdraw_dbdt');
            $table->float('staking_dbdt');
            $table->float('frozen_dbdt');
            $table->integer('overridelevel');
            $table->tinyInteger('status');
            $table->integer('bonus');
            $table->integer('bonus_period');
            $table->string('mastercard_type');
            $table->string('description');
            $table->integer('package_order');

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
        Schema::dropIfExists('packages');
    }
}

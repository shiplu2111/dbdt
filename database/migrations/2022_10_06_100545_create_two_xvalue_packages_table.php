<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoXvaluePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('two_xvalue_packages', function (Blueprint $table) {
            $table->id();
            $table->string('packagename');
            $table->float('usdtprice');
            $table->float('dbdtprice');
            $table->integer('overridelevel');
            $table->tinyInteger('status');
            $table->integer('bonus_period');
            $table->integer('bonus');
            $table->string('mastercard_type');
            $table->string('description');
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
        Schema::dropIfExists('two_xvalue_packages');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('package_id');
            $table->string('user_id');
            $table->string('order_id')->unique();
            $table->string('tax')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('pay_code')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('pack_invoices');
    }
}

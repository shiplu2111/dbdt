<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastercardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mastercards', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('birth_day');
            $table->string('country');
            $table->string('address');
            $table->string('city');
            $table->string('zip_code');
            $table->string('phone')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('id_country');
            $table->string('id_type');
            $table->string('id_number')->unique();
            $table->string('bank_country');
            $table->string('bank_name');
            $table->string('brunch_name');
            $table->string('card_no')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('currency');
            $table->string('account_holder_name');
            $table->string('account_number');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('mastercards');
    }
}

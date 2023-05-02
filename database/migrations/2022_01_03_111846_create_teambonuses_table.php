<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeambonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teambonuses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('level1');
            $table->integer('level2')->nullable();
            $table->integer('level3')->nullable();
            $table->integer('level4')->nullable();
            $table->integer('level5')->nullable();
            $table->integer('level6')->nullable();
            $table->integer('level7')->nullable();
            $table->integer('level8')->nullable();
            $table->integer('level9')->nullable();
            $table->integer('level10')->nullable();
            $table->integer('level11')->nullable();
            $table->integer('level12')->nullable();
            $table->integer('level1_id');
            $table->integer('level2_id')->nullable();
            $table->integer('level3_id')->nullable();
            $table->integer('level4_id')->nullable();
            $table->integer('level5_id')->nullable();
            $table->integer('level6_id')->nullable();
            $table->integer('level7_id')->nullable();
            $table->integer('level8_id')->nullable();
            $table->integer('level9_id')->nullable();
            $table->integer('level10_id')->nullable();
            $table->integer('level11_id')->nullable();
            $table->integer('level12_id')->nullable();
            $table->integer('dev_fund');

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
        Schema::dropIfExists('teambonuses');
    }
}

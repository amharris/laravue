<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_points', function (Blueprint $table) {
            $table->id();
            $table->string('rule_name');
            $table->string('type')->default('rate');
            $table->integer('rate')->default(1);
            $table->integer('point');
            $table->timestamps();
        });

        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('point_min');
            $table->timestamps();
        });

        Schema::create('reward_redeems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reward_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('reward_id')->references('id')->on('rewards');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_redeems');
        Schema::dropIfExists('rewards');
        Schema::dropIfExists('reward_points');
    }
}

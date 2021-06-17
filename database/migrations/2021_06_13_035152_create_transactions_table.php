<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->string('reference_id');
            $table->decimal('total_payment');
            $table->unsignedBigInteger('point_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('point_id')->references('id')->on('reward_points');
        });

        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trx_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('qty');
            $table->decimal('price');
            $table->decimal('total_price');
            $table->timestamps();

            $table->foreign('trx_id')->references('id')->on('transactions');
            $table->foreign('item_id')->references('id')->on('transaction_items');
        });

        Schema::create('transaction_bags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_payment');
            $table->boolean('submitted')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('transaction_bag_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('bag_id');
            $table->integer('qty');
            // $table->decimal('price');
            $table->decimal('total_price');
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('transaction_items');
            $table->foreign('bag_id')->references('id')->on('transaction_bags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_bag_items');
        Schema::dropIfExists('transaction_bags');
        Schema::dropIfExists('transaction_details');
        Schema::dropIfExists('transaction_items');
        Schema::dropIfExists('transactions');
    }
}

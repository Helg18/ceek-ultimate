<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('mid')->unique();
            $table->timestamps();
            $table->string('charge_id')->nullable();
            $table->string('object')->nullable();
            $table->integer('created')->nullable();
            $table->boolean('livemode')->default(0);
            $table->boolean('paid')->default(0);
            $table->string('status')->nullable();
            $table->integer('amount')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('refunded')->default(0);
            
            $table->boolean('captured')->default(0);
            $table->string('balance_transaction')->nullable();
            $table->integer('amount_refunded')->nullable();
            $table->string('customer')->nullable();
            $table->text('fraud_details')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mid')->unique();
            $table->timestamps();
            $table->timestamp('purchased_at');
            $table->string('purchase_path');
            $table->string('name');
            $table->integer('price')->unsigned();
            $table->integer('paid')->unsigned();
            $table->integer('charged')->unsigned();
            $table->integer('balance')->unsigned();
            $table->string('promo_codes')->nullable();
            $table->text('billed_to')->nullable();
            $table->text('shipped_to')->nullable();
            $table->text('items')->nullable();
            $table->text('user')->nullable();
            $table->text('transaction')->nullable();
            $table->text('purchase')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('receipts');
    }
}

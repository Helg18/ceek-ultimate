<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->unsigned();
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
            $table->string('product');
            $table->integer('amount');
            $table->string('stripe_transaction_id');
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
        Schema::drop('sold');
    }
}

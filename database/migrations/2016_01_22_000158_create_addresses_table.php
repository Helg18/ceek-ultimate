<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mid')->unique();
            $table->timestamps();
            $table->string('line_1');
            $table->string('line_2')->nullable();
            $table->string('line_3')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('country');
            $table->boolean('shipping_address');
            $table->boolean('billing_address');
            $table->string('other_details')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
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
        Schema::drop('addresses');
    }
}

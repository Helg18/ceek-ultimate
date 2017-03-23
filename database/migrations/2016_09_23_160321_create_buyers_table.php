<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table)
        {
            $table->increments('id');   
            $table->timestamps();
            $table->string('billing_name');
            $table->string('billing_lastname');
            $table->string('billing_email');
            $table->text('billing_address');
            $table->string('billing_country');
            $table->string('billing_state');
            $table->string('billing_city');
            $table->integer('billing_zipcode');
            $table->integer('billing_phone');
            $table->string('shipping_name');
            $table->string('shipping_lastname');
            $table->text('shipping_address');
            $table->string('shipping_country');
            $table->string('shipping_state');
            $table->string('shipping_city');
            $table->integer('shipping_zipcode');
            $table->string('stripe_customer_id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buyers');
    }
}

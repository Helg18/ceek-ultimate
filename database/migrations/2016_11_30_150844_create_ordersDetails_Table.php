<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordersDetails', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('pro_id')->unsigned();
            $table->foreign('pro_id')->references('id')->on('products');
            $table->integer('ord_id')->unsigned();
            $table->foreign('ord_id')->references('id')->on('orders');
            $table->decimal('price', 5, 2);
            $table->decimal('shipping', 5, 2);
            $table->integer('quantity');
            $table->string('status')->default('ACTIVE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ordersDetails');
    }
}

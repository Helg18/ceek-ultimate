<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_catalog', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('cart_id')->unsigned()->nullable();
            $table->integer('catalog_id')->unsigned()->nullable();
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cart_catalog');
    }
}

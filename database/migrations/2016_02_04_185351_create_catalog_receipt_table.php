<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_receipt', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('catalog_id')->unsigned()->nullable();
            $table->integer('receipt_id')->unsigned()->nullable();
            $table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->foreign('receipt_id')->references('id')->on('receipts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalog_receipt');
    }
}

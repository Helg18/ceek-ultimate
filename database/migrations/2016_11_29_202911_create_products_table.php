<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories');
            $table->timestamps();                    
            $table->string('title');
            $table->string('image');
            $table->string('model');        
            $table->text('description');
            $table->integer('quantity')->default('1');
            $table->decimal('price', 5, 2);
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
        Schema::drop('products');
    }
}

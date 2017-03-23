<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Catalogable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogables', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('catalog_id')->unsigned();
            $table->integer('catalogable_id')->unsigned();
            $table->string('catalogable_type');
            $table->index(['catalogable_id', 'catalogable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('catalogables');
    }
}

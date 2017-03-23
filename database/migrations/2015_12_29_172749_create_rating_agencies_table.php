<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mid')->unique();
            $table->timestamps();
            $table->string('name');
            $table->string('abbreviation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rating_agencies');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mid')->unique();
            $table->timestamps();
            $table->string('slug')->unique()->nullable();
            $table->string('file_file_name');
            $table->integer('file_file_size');
            $table->string('file_content_type');
            $table->string('file_updated_at');
            $table->string('full');
            $table->string('path_xlarge');
            $table->string('path_large');
            $table->string('path_medium');
            $table->string('path_small');
            $table->string('path_xsmall');
            $table->integer('user_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}

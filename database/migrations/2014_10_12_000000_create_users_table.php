<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mid')->unique();
            $table->timestamps();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('login_name')->unique();
            $table->string('password', 60);
            $table->integer('dob')->unsigned();
            $table->tinyInteger('gender')->unsigned();
            $table->integer('profile_image_id')->unsigned()->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

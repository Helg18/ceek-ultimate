<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mid')->unique();
            $table->timestamps();
            $table->smallInteger('Gender')->default(-1);
            $table->smallInteger('Hair')->default(-1);
            $table->smallInteger('EyeColor')->default(-1);
            $table->smallInteger('SkinColor')->default(-1);
            $table->smallInteger('Tops')->default(-1);
            $table->smallInteger('Bottoms')->default(-1);
            $table->smallInteger('Shoes')->default(-1);
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
        Schema::drop('avatars');
    }
}

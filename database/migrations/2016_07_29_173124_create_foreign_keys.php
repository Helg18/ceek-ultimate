<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('profile_image_id')->references('id')->on('images');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('avatars', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->foreign('rating_id')->references('id')->on('ratings');
        });
        Schema::table('ratings', function (Blueprint $table) {
            $table->foreign('rating_agency_id')->references('id')->on('rating_agencies');
        });
        Schema::table('purchases', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('catalog_id')->references('id')->on('catalogs');
        });
        Schema::table('tokens', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('catalogables', function (Blueprint $table) {
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_profile_image_id_foreign');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_user_id_foreign');
        });
        Schema::table('avatars', function (Blueprint $table) {
            $table->dropForeign('avatars_user_id_foreign');
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign('videos_rating_id_foreign');
        });
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign('ratings_rating_agency_id_foreign');
        });
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign('purchases_user_id_foreign');
            $table->dropForeign('purchases_catalog_id_foreign');
        });
        Schema::table('tokens', function (Blueprint $table) {
            $table->dropForeign('tokens_user_id_foreign');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_user_id_foreign');
        });
        Schema::table('catalogables', function (Blueprint $table) {
            $table->dropForeign('catalogables_catalog_id_foreign');
        });
    }
}

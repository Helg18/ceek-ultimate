<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatalogExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogs', function (Blueprint $table) {
            $table->string('name');
            $table->boolean('is_valid')->default(true);
            $table->boolean('admin_disabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogs', function ($table) {
            $table->dropColumn('name');
            $table->dropColumn('is_valid');
            $table->dropColumn('admin_disabled');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromoExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promos', function (Blueprint $table)
        {
            $table->string('name');
            $table->string('description');
            $table->integer('promo_cost');
            $table->timestamp('starts');
            $table->timestamp('expires')->default('1970-01-02 00:00:00');
            $table->boolean('admin_invalidated')->default(false);
            $table->string('catalog_id')->index()->nullable();
            $table->string('project_id')->index()->nullable();
            $table->string('team_id')->index()->nullable();
            $table->timestamp('cogen_updated_at');
            $table->timestamp('cogen_created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promos', function ($table)
        {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->dropColumn('promo_cost');
            $table->dropColumn('starts');
            $table->dropColumn('expires');
            $table->dropColumn('admin_invalidated');
            $table->dropColumn('catalog_id');
            $table->dropColumn('project_id');
            $table->dropColumn('team_id');
            $table->dropColumn('cogen_updated_at');
            $table->dropColumn('cogen_created_at');
        });
    }
}

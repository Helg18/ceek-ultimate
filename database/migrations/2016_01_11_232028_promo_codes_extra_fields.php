<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromoCodesExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promo_codes', function (Blueprint $table)
        {
            $table->string('code')->unique();
            $table->boolean('used')->default(false);
            $table->boolean('admin_invalidated')->default(false);
            $table->string('promo_id')->index()->nullable();
            $table->string('team_id')->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promo_codes', function ($table)
        {
            $table->dropColumn('code');
            $table->dropColumn('used');
            $table->dropColumn('admin_invalidated');
            $table->dropColumn('promo_id');
            $table->dropColumn('team_id');
        });
    }
}

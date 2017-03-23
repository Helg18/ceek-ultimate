<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayRightsColumnUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('play_rights', function (Blueprint $table) {
             $table->dropColumn('playsLeft');
             $table->dropColumn('playEnds');
         });
         Schema::table('play_rights', function (Blueprint $table) {
             $table->integer('plays_left');
             $table->timestamp('play_ends')->nullable()->default(null);
             $table->boolean('plays_unlimited')->default(false);
         });
     }
     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('play_rights', function ($table) {
             $table->dropColumn('plays_left');
             $table->dropColumn('play_ends');
             $table->dropColumn('plays_unlimited');
         });
     }
}

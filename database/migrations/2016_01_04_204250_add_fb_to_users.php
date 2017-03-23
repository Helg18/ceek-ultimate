<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFbToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('users', function (Blueprint $table) {
             $table->string('fb_id')->index()->nullable();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('users', function ($table) {
             $table->dropColumn('fb_id');
         });
     }
}

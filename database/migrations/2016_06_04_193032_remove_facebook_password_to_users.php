<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFacebookPasswordToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('users', function (Blueprint $table) {
             $table->dropColumn('fb_password');
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
             $table->string('fb_password')->nullable();
         });
     }
}

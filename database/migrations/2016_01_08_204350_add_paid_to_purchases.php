<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidToPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('purchases', function (Blueprint $table) {
             $table->dropColumn('usesLeft');
             $table->dropColumn('useEnds');
             $table->dropColumn('useLength');
             $table->integer('paid')->default(0);
             $table->string('purchasePath');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('purchases', function ($table) {
             $table->dropColumn('paid');
             $table->dropColumn('purchasePath');
         });
     }
}

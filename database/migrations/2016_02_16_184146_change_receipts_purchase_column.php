<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReceiptsPurchaseColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropColumn('purchase');
            $table->dropColumn('purchase_path');
        });
        Schema::table('receipts', function (Blueprint $table) {
            $table->text('purchases')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receipts', function (Blueprint $table) {
            $table->dropColumn('purchases');
        });
        Schema::table('receipts', function (Blueprint $table) {
            $table->text('purchase')->nullable();
            $table->text('purchase_path')->nullable();
        });
    }
}

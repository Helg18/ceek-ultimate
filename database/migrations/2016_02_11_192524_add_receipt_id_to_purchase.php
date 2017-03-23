<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReceiptIdToPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->integer('receipt_id')->unsigned()->nullable();
            $table->foreign('receipt_id')->references('id')->on('receipts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign('purchases_receipt_id_foreign');
            $table->dropColumn('receipt_id');
        });
    }
}

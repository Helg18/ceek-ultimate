<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionsExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function ($table) {
            $table->dropColumn('fraud_details');
        });
        Schema::table('transactions', function ($table) {
            $table->string('application_fee')->nullable();
            $table->string('description')->nullable();
            $table->string('destination')->nullable();
            $table->string('dispute')->nullable();
            $table->string('failure_code')->nullable();
            $table->string('failure_message')->nullable();
            $table->string('invoice')->nullable();
            $table->string('order')->nullable();
            $table->string('receipt_email')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('shipping')->nullable();
            $table->string('statement_descriptor')->nullable();
            $table->string('fraud_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function ($table)
        {
            $table->dropColumn('application_fee');
            $table->dropColumn('description');
            $table->dropColumn('destination');
            $table->dropColumn('dispute');
            $table->dropColumn('failure_code');
            $table->dropColumn('failure_message');
            $table->dropColumn('invoice');
            $table->dropColumn('order');
            $table->dropColumn('receipt_email');
            $table->dropColumn('receipt_number');
            $table->dropColumn('shipping');
            $table->dropColumn('statement_descriptor');
            $table->dropColumn('fraud_details');
        });
    }
}

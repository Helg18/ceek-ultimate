<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Sellout\IoLog;

class ChangeIologsToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::rename('io_logs','io_logs_old');
         Schema::create('io_logs', function (Blueprint $table) {
             $table->increments('id');
             $table->string('mid')->unique();
             $table->timestamps();
             $table->string('request_method');
             $table->string('request_url');
             $table->string('request_ip');
             $table->text('request_header');
             $table->text('request_server');
             $table->text('request_raw');
             $table->text('request_input_parsed');
             $table->text('request_input_json');
             $table->text('response_header');
             $table->string('response_status');
             $table->text('response_content');
             $table->string('io_log_type');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('io_logs');
         Schema::rename('io_logs_old','io_logs');
     }
}

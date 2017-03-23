<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIologsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('io_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mid')->unique();
            $table->string('request_method');
            $table->string('request_url');
            $table->string('request_ip');
            $table->string('request_header');
            $table->string('request_server');
            $table->string('request_raw');
            $table->string('request_input_parsed');
            $table->string('request_input_json');
            $table->string('response_header');
            $table->string('response_status');
            $table->text('response_content');
            $table->string('io_log_type');
            $table->timestamps();
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
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_reply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('belong_to')->comment = '归属ticket的ID';
            $table->integer('uid');
            $table->text('content');
            $table->text('attachment')->nullable();
            $table->dateTime('reply_time');
            $table->softDeletes();
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
        Schema::drop('ticket_reply');
    }
}

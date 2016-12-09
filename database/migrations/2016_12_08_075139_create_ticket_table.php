<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->comment = '开设ticket用户id';
            $table->string('title');
            $table->tinyInteger('status')->default(1)->comment = '工单状态，1为开启，2为关闭';
            $table->text('content')->nullable();
            $table->text('attachment')->nullable();
            $table->dateTime('open_time')->comment = '创建ticket时间';
            $table->dateTime('last_update')->comment = '最后更新时间';
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticket');
    }
}

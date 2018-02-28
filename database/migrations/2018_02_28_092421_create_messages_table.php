<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->comment('评论内容');
            $table->integer('like')->nullable()->comment('赞');
            $table->integer('oppose')->nullable()->comment('反对');
            $table->integer('type')->defualt(1)->comment('权限类型：默认1为隐藏，仅管理员能看到，2为公开消息');
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
        Schema::dropIfExists('messages');
    }
}

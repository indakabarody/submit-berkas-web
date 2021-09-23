<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id')->index('fk_chats_admins1_idx');
            $table->unsignedBigInteger('member_id')->index('fk_chats_members1_idx');
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->tinyInteger('is_from_member')->nullable();
            $table->tinyInteger('is_from_admin')->nullable();
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('chats');
    }
}

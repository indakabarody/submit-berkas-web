<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('admin_id', 'fk_chats_admins1')->references('id')->on('admins')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('member_id', 'fk_chats_members1')->references('id')->on('members')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign('fk_chats_admins1');
            $table->dropForeign('fk_chats_members1');
        });
    }
}

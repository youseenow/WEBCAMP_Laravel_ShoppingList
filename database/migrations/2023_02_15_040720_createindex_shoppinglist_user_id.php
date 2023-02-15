<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateindexShoppinglistUserId extends Migration
{
    // ==================== ▼▼▼ shopping_listsテーブルのINDEX ▼▼▼ ====================
    public function up()
    {
        Schema::table('shopping_lists', function (Blueprint $table) {
            $table->index('user_id');
        });
    }

    // ==================== ▼▼▼ INDEXの削除 ▼▼▼ ====================
    public function down()
    {
        Schema::table('shopping_lists', function (Blueprint $table) {
            $table->dropIndex('user_id');
        });
    }
}

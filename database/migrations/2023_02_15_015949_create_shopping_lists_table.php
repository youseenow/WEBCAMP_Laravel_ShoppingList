<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingListsTable extends Migration
{
    // ==================== ▼▼▼ 買い物リスト登録用 ▼▼▼ ====================
    public function up()
    {
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('「買うもの」の名前');
            $table->unsignedBigInteger('user_id')->comment('「買うもの」を登録した人');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_lists');
    }
}

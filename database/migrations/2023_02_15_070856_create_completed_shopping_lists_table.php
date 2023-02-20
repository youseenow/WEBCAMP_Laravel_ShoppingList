<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletedShoppingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completed_shopping_lists', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('name')->comment('「買うもの」の名前');
            $table->unsignedBigInteger('user_id')->comment('「買うもの」を登録した人');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('created_at')->useCurrent()->comment('購入日');
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completed_shopping_lists');
    }
}

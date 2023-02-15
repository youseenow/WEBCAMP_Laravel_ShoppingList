<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;

class CompletedShoppingListController extends Controller
{


    // ========== ▼▼▼ 購入済み「買うもの」一覧画面の表示 ▼▼▼ ==========
    public function list() {

        // ---------- ▽▽▽ 1ページに表示する数 ▽▽▽ ----------
        $per_page = 5;

        // ---------- ▽▽▽ 一覧の取得 ▽▽▽ ----------
        $list = CompletedShoppingListModel::where('user_id', Auth::id())->orderBy('id', 'ASC')->paginate($per_page);

        // ---------- ▽▽▽ 一覧の表示 ▽▽▽ ----------
        return view('completed_shopping_list.list', ['list' => $list]);

    }


}

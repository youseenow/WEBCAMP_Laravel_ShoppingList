<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShoppingListRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ShoppingList as ShoppingListModel;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;

class ShoppingListController extends Controller
{


    // ==================== ▼▼▼ 「買うもの」一覧ページの表示 ▼▼▼ ====================
    public function list() {

        // ---------- ▽▽▽ 1ページに表示する数 ▽▽▽ ----------
        $per_page = 5;

        // ---------- ▽▽▽ 一覧の取得 ▽▽▽ ----------
        $list = ShoppingListModel::where('user_id', Auth::id())->orderBy('name', 'asc')->paginate($per_page);

        // ---------- ▽▽▽ 一覧の表示 ▽▽▽ ----------
        return view('shopping_list.list', ['list' => $list]);

    }



    // ==================== ▼▼▼ 「買うもの」登録 ▼▼▼ ====================
    public function register(ShoppingListRegisterRequest $request) {

        // ---------- ▽▽▽ バリデーション済みデータの取得 ▽▽▽ ----------
        $datum = $request->validated();

        // ---------- ▽▽▽ user_idの追加 ▽▽▽ ----------
        $datum['user_id'] = Auth::id();

        // ---------- ▽▽▽ テーブルへのインサート ▽▽▽ ----------
        try {
            $r = ShoppingListModel::create($datum);
        } catch(\Throwable $e) {
            echo $e->getMessage();
            exit;
        }

        // ---------- ▽▽▽ 登録完了メッセージ ▽▽▽ ----------
        $request->session()->flash('shopping_list_register_success', true);

        // ---------- ▽▽▽ リダイレクト ▽▽▽ ----------
        return redirect(route('front.list'));

    }



    // ==================== ▼▼▼ 「買うもの」完了 ▼▼▼ ====================
    public function complete(Request $request, $list_id) {

        // ---------- ▽▽▽ 「買うもの」を完了テーブルに移動させる ▽▽▽ ----------
        try {

            // ----- ▽▽▽ トランザクション開始 ▽▽▽ -----
            DB::beginTransaction();

            // ▽▽▽ レコードを取得する ▽▽▽
            $list = ShoppingListModel::find($list_id);
            if ($list === null) {
                throw new \Exception('');
            }

            // ▽▽▽ 未購入のテーブル側を削除する ▽▽▽
            $list->delete();

            // ▽▽▽ 購入済みのテーブル側にインサートする ▽▽▽
            $dask_datum = $list->toArray();
            unset($dask_datum['created_at']);
            unset($dask_datum['updated_at']);
            $r = CompletedShoppingListModel::create($dask_datum);
            if ($r === null) {
                throw new \Exception('');
            }

            // ----- ▽▽▽ トランザクション終了 ▽▽▽ -----
            DB::commit();

            // ----- ▽▽▽ 完了メッセージ ▽▽▽ -----
            $request->session()->flash('shopping_list_completed_success', true);

        } catch(\Throwable $e) {

            // ----- ▽▽▽ トランザクション異常終了 ▽▽▽ -----
            DB::rollBack();

            // ----- ▽▽▽ 失敗メッセージ ▽▽▽ -----
            $request->session()->flash('shopping_list_completed_failure', true);

        }
        // ---------- ▽▽▽ 一覧に遷移する ▽▽▽ ----------
        return redirect(route('front.list'));

    }



    // ==================== ▼▼▼ 「買うもの」削除 ▼▼▼ ====================
    public function delete(Request $request, $list_id) {

        // ---------- ▽▽▽ レコードを取得する ▽▽▽ ----------
        $list = ShoppingListModel::find($list_id);

        // ---------- ▽▽▽ 「買うもの」を削除する ▽▽▽ ----------
        if ($list !== null) {
            $list->delete();
            /* ▽▽▽ 完了メッセージ ▽▽▽ */
            $request->session()->flash('shopping_list_delete_success', true);
        }

        // ---------- ▽▽▽ 一覧ページに遷移する ▽▽▽ ----------
        return redirect(route('front.list'));

    }


}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\CompletedShoppingListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ==================== ▼▼▼ 買い物リストトップページ（ログイン） ▼▼▼ ====================
Route::get('/', [AuthController::class, 'index'])->name('front.index');
Route::post('/login', [AuthController::class, 'login']);



// ==================== ▼▼▼ 会員登録 ▼▼▼ ====================
Route::prefix('/user')->group(function () {
    // -------------------- ▽▽▽ ユーザー登録画面の表示 ▽▽▽ --------------------
    Route::get('/register', [UserController::class, 'index']);
    // -------------------- ▽▽▽ ユーザー登録 ▽▽▽ --------------------
    Route::post('/register', [UserController::class, 'register']);
});



// ==================== ▼▼▼ 認可処理 ▼▼▼ ====================
Route::middleware(['auth'])->group(function () {

    // -------------------- ▽▽▽ 「買うもの」リスト ▽▽▽ --------------------
    Route::prefix('/shopping_list')->group(function () {
        // ---------- ▽▽▽ 一覧表示 ▽▽▽ ----------
        Route::get('/list', [ShoppingListController::class, 'list'])->name('front.list');
        // ---------- ▽▽▽ 登録機能 ▽▽▽ ----------
        Route::post('/register', [ShoppingListController::class, 'register']);
        // ---------- ▽▽▽ 完了機能 ▽▽▽ ----------
        Route::post('/complete/{list_id}', [ShoppingListController::class, 'complete'])->whereNumber('list_id')->name('complete');
        // ---------- ▽▽▽ 削除機能 ▽▽▽ ----------
        Route::delete('/delete/{list_id}', [ShoppingListController::class, 'delete'])->whereNumber('list_id')->name('delete');
    });

    // -------------------- ▽▽▽ 購入済み「買うもの」リスト ▽▽▽ --------------------
    Route::get('/completed_shopping_list/list', [CompletedShoppingListController::class, 'list']);

    // -------------------- ▽▽▽ ログアウト ▽▽▽ --------------------
    Route::get('/logout', [AuthController::class, 'logout']);

});



// ==================== ▼▼▼ 管理画面 ▼▼▼ ====================
Route::prefix('/admin')->group(function () {
    // ---------- ▽▽▽ トップページ表示 ▽▽▽ ----------
    Route::get('', [AdminAuthController::class, 'index'])->name('admin.index');
    // ---------- ▽▽▽ ログイン ▽▽▽ ----------
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');

    Route::middleware(['auth:admin'])->group(function () {
        // ---------- ▽▽▽ ログイン後トップページ表示 ▽▽▽ ----------
        Route::get('/top', [AdminHomeController::class, 'top'])->name('admin.top');
        // ---------- ▽▽▽ ユーザー一覧 ▽▽▽ ----------
        Route::get('/user/list', [AdminUserController::class, 'list'])->name('admin.user.list');
    });

    // ---------- ▽▽▽ ログアウト ▽▽▽ ----------
    Route::get('/logout', [AdminAuthController::class, 'logout']);

});


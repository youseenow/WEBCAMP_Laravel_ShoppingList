<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    // ==================== ▼▼▼ ユーザー登録ページの表示 ▼▼▼ ====================
    public function index() {
        return view('user.register');
    }



    // ==================== ▼▼▼ ユーザー登録 ▼▼▼ ====================
    public function register(UserRegisterRequest $request) {

        // ---------- ▽▽▽ バリデーション済みデータの受け取り ▽▽▽ ----------
        $datum = $request->validated();
        $datum['password'] = Hash::make($datum['password']);

        // ---------- ▽▽▽ テーブルへのインサート ▽▽▽ ----------
        try {
            $r = UserModel::create($datum);
        } catch(\Throwable $e) {
            echo $e->getMessage();
            exit;
        }

        // ---------- ▽▽▽ 登録完了メッセージ ▽▽▽ ----------
        $request->session()->flash('user_register_success', true);

        // ---------- ▽▽▽ リダイレクト ▽▽▽ ----------
        return redirect(route('front.index'));

    }


}

<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    // ==================== ▼▼▼ 買い物リストトップページの表示 ▼▼▼ ====================
    public function index() {
        return view('index');
    }



    // ==================== ▼▼▼ ログイン ▼▼▼ ====================
    public function login(LoginRequest $request) {

        // ---------- ▽▽▽ データの取得 ▽▽▽ ----------
        $datum = $request->validated();

        // ---------- ▽▽▽ 認証 ▽▽▽ ----------
        if (Auth::attempt($datum) === false) {
            return back()
                    ->withInput() // 入力値の保持
                    ->withErrors(['auth' => 'emailかパスワードに誤りがあります。']); // エラーメッセージの出力
        }
        $request->session()->regenerate();

        // ---------- ▽▽▽ リダイレクト ▽▽▽ ----------
        return redirect()->intended('/shopping_list/list');

    }



    // ==================== ▼▼▼ ログアウト ▼▼▼ ====================
    public function logout(Request $request) {

        // ---------- ▽▽▽ ログアウトの処理 ▽▽▽ ----------
        Auth::logout();

        // ---------- ▽▽▽ CSRFトークンの再生成 ▽▽▽ ----------
        $request->session()->regenerateToken();

        // ---------- ▽▽▽ セッションIDの再生成 ▽▽▽ ----------
        $request->session()->regenerate();

        // ---------- ▽▽▽ ログアウトしたらトップページにリダイレクト ▽▽▽ ----------
        return redirect(route('front.index'));

    }

}

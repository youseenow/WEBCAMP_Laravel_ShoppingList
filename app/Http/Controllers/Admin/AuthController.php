<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    // ==================== ▼▼▼ 管理画面トップページの表示 ▼▼▼ ====================
    public function index() {
        return view('admin.index');
    }



    // ==================== ▼▼▼ ログイン ▼▼▼ ====================
    public function login(AdminLoginRequest $request) {

        // ---------- ▽▽▽ データの取得 ▽▽▽ ----------
        $datum = $request->validated();

        // ---------- ▽▽▽ 認証 ▽▽▽ ----------
        if (Auth::guard('admin')->attempt($datum) === false) {
            return back()
                    ->withInput() // 入力値の保持
                    ->withErrors(['auth' => 'ログインIDかパスワードに誤りがあります。']); // エラーメッセージの出力
        }
        $request->session()->regenerate();

        // ---------- ▽▽▽ リダイレクト ▽▽▽ ----------
        return redirect()->intended('/admin/top');

    }



    // ==================== ▼▼▼ ログアウト ▼▼▼ ====================
    public function logout(Request $request) {

        // ---------- ▽▽▽ ログアウトの処理 ▽▽▽ ----------
        Auth::guard('admin')->logout();

        // ---------- ▽▽▽ CSRFトークンの再生成 ▽▽▽ ----------
        $request->session()->regenerateToken();

        // ---------- ▽▽▽ セッションIDの再生成 ▽▽▽ ----------
        $request->session()->regenerate();

        // ---------- ▽▽▽ ログアウトしたらトップページにリダイレクト ▽▽▽ ----------
        return redirect(route('admin.index'));

    }

}

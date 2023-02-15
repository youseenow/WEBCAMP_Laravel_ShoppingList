<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    // ==================== ▼▼▼ 管理画面ログイン後トップページの表示 ▼▼▼ ====================
    public function top() {
        return view('admin.top');
    }

}

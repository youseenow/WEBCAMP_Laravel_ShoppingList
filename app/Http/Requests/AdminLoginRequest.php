<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{


    // ==================== ▼▼▼ 買い物リスト管理画面 ▼▼▼ ====================
    public function rules()
    {
        return [
            'login_id' => ['required', 'max:255'],
            'password' => ['required', 'max:72'],
        ];
    }


}

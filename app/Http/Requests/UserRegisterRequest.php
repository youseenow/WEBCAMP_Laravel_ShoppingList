<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{


    // ==================== ▼▼▼ ユーザー登録 ▼▼▼ ====================
    public function rules()
    {
        return [
            'name' => ['required', 'max:128'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', 'max:72'],
            'password_check' => ['required', 'same:password'],
        ];
    }


}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{


    // ==================== ▼▼▼ 買い物リストログイン ▼▼▼ ====================
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', 'max:72'],
        ];
    }


}

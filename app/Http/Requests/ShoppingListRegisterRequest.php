<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingListRegisterRequest extends FormRequest
{


    // ==================== ▼▼▼ 買い物リスト登録 ▼▼▼ ====================
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
        ];
    }


}

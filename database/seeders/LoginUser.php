<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginUser extends Seeder
{
    // ==================== ▼▼▼ 買い物リストログインユーザー ▼▼▼ ====================
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ユーザー1',
            'email' => 'hoge@example.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('pass'),
        ]);
    }
}

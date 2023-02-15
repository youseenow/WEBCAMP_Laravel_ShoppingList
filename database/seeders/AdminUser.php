<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Seeder
{
    // ==================== ▼▼▼ 買い物リスト管理者 ▼▼▼ ====================
    public function run()
    {
        DB::table('admin_users')->insert([
            'login_id' => 'hogemin',
            'password' => Hash::make('pass'),
        ]);
    }
}

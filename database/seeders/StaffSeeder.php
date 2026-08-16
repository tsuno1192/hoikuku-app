<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 30名分のダミースタッフを作成
        for ($i = 1; $i <= 30; $i++) {
            User::create([
                'staff_id' => 'STF' . str_pad($i, 3, '0', STR_PAD_LEFT), // 例: STF001, STF002...
                'name' => 'スタッフ ' . $i,
                'email' => 'staff' . $i . '@example.com',
                'password' => Hash::make('password123'), // 共通のパスワード
                // 'role' => 'staff', // 役割カラムがある場合は適宜追加
            ]);
        }
    }
}

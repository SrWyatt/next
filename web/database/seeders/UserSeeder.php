<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('123456');

        DB::table('admins')->insert([
            ['username' => 'wyatt', 'password' => $password, 'email' => 'admin@sistema.com'],
            ['username' => 'adm1', 'password' => $password, 'email' => 'admin@sistema.com'],
        ]);

        DB::table('support')->insert([
            ['username' => 'sys1', 'password' => $password, 'area' => 'Soporte Técnico'],
        ]);

        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'username' => "user$i",
                'password' => $password,
                'email' => "user$i@mail.com",
                'balance' => 0.00
            ]);
        }
    }
}

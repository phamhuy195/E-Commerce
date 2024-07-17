<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'User',
                'username' => 'User',
                'email' => 'user@gmail',
                'role' => 'user',
                'status' => 'active',
                'password' => bcrypt('12345678')
            ]
        ]);
    }
}

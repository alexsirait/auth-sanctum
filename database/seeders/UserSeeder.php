<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Alex Sirait',
            'email' => 'alex@example.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan kata sandi yang diinginkan
            // tambahkan kolom lain jika diperlukan
        ]);
    }
}
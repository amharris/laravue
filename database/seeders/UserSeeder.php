<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Satu',
            'email' => 'admin1@example.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'User Biasa Satu',
            'email' => 'user1@example.com',
            'password' => Hash::make('user123'),
            'is_admin' => false,
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'User Biasa Dua',
            'email' => 'user2@example.com',
            'password' => Hash::make('user234'),
            'is_admin' => false,
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
    }
}

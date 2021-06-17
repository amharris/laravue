<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reward_points')->insert([
            'rule_name' => 'Diskon Khusus',
            'rate' => 100,
            'point' => 1,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('rewards')->insert([
            'name' => 'Hadiah Utama',
            'point_min' => 100,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('rewards')->insert([
            'name' => 'Hadiah Kedua',
            'point_min' => 50,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('rewards')->insert([
            'name' => 'Hadiah Ketiga',
            'point_min' => 25,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('rewards')->insert([
            'name' => 'Hadiah Keempat',
            'point_min' => 10,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('rewards')->insert([
            'name' => 'Hadiah Kelima',
            'point_min' => 5,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}

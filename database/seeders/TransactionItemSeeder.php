<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_items')->insert([
            'name' => 'Barang Satu',
            'price' => 125000.0,
            'description' => false,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('transaction_items')->insert([
            'name' => 'Barang Dua',
            'price' => 50000.0,
            'description' => false,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('transaction_items')->insert([
            'name' => 'Barang Tiga',
            'price' => 75000.0,
            'description' => false,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('transaction_items')->insert([
            'name' => 'Barang Empat',
            'price' => 250000.0,
            'description' => false,
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('transaction_items')->insert([
            'name' => 'Barang Lima',
            'price' => 150000.0,
            'description' => false,
            'created_at' => \Carbon\Carbon::now()
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'customer_id' => 1,
            'product_id' => 1,
            'name' => 'INV001',
            'slug' => 'inv-001',
            'tgl' => '2023/03/21',
            'tenor' => 9,
            'dp' => 1000000,
            'amount' => 350000,
        ]);
    }
}

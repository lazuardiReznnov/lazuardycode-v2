<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'name' => 'Juned',
            'slug' => 'juned',
            'nik' => '00002222122',
            'email' => 'juned@gmail.com',
            'phone' => '09837844',
            'address' => 'Jakarta',
        ]);
    }
}

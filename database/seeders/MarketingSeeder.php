<?php

namespace Database\Seeders;

use App\Models\Marketing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marketing::create([
            'name' => 'Bayu Prasetya',
            'slug' => 'apek',
            'nik' => '0009933884',
            'phone' => '085766666',
            'email' => 'bayuapek@gmail.com',
            'address' => 'Bogor',
        ]);
    }
}

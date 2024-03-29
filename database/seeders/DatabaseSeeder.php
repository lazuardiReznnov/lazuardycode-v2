<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Lazuardi',
            'username' => 'lazuardireznnov',
            'email' => 'lazuardi.reznnov@gmail.com',
            'password' =>
                '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $this->call([
            FintechSeeder::class,
            CategoryProductSeeder::class,
            // ProductSeeder::class,
            MarketingSeeder::class,
            CustomerSeeder::class,
            // TransactionSeeder::class,
            AcountSeeder::class,
        ]);
    }
}

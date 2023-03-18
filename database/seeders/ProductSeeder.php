<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_product_id' => 1,
            'name' => 'Samsung Galaxy A13 4/128',
            'slug' => 'samsung-galaxy-a13-4128',
            'brand' => 'Samsung',
            'descriptions' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus quaerat veniam obcaecati, numquam officia esse cum alias illum ipsam iste.',
        ]);

        Product::create([
            'category_product_id' => 1,
            'name' => 'Samsung Galaxy A03 4/64',
            'slug' => 'samsung-galaxy-a03-464',
            'brand' => 'Samsung',
            'descriptions' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus quaerat veniam obcaecati, numquam officia esse cum alias illum ipsam iste.',
        ]);
        Product::create([
            'category_product_id' => 1,
            'name' => 'Oppo A54',
            'slug' => 'samsung-galaxy-a03',
            'brand' => 'Samsung',
            'descriptions' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus quaerat veniam obcaecati, numquam officia esse cum alias illum ipsam iste.',
        ]);
    }
}

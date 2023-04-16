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
        $product = Product::create([
            'category_product_id' => 1,
            'name' => 'Samsung Galaxy A13 4/128',
            'slug' => 'samsung-galaxy-a13-4128',
            'brand' => 'Samsung',
            'descriptions' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus quaerat veniam obcaecati, numquam officia esse cum alias illum ipsam iste.',
        ]);
        $product->pricing()->create([
            'cash' => 3000000,
            'dp' => 300000,
            'three' => 870000,
            'six' => 450000,
            'nine' => 275000,
        ]);

        $product2 = Product::create([
            'category_product_id' => 1,
            'name' => 'Samsung Galaxy A03 4/64',
            'slug' => 'samsung-galaxy-a03-464',
            'brand' => 'Samsung',
            'descriptions' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus quaerat veniam obcaecati, numquam officia esse cum alias illum ipsam iste.',
        ]);

        $product2->pricing()->create([
            'cash' => 2000000,
            'dp' => 300000,
            'three' => 600000,
            'six' => 450000,
            'nine' => 275000,
        ]);

        $product3 = Product::create([
            'category_product_id' => 3,
            'name' => 'Oppo A54',
            'slug' => 'oppo-a54',
            'brand' => 'Oppo',
            'descriptions' =>
                'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus quaerat veniam obcaecati, numquam officia esse cum alias illum ipsam iste.',
        ]);
        $product3->pricing()->create([
            'cash' => 3000000,
            'dp' => 300000,
            'three' => 870000,
            'six' => 450000,
            'nine' => 275000,
        ]);
    }
}

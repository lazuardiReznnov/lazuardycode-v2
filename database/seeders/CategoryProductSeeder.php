<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryProduct;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryProduct::create([
            'name' => 'Smartphone',
            'slug' => 'smartphone',
            'descriptions' =>
                'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi, obcaecati.',
        ]);

        CategoryProduct::create([
            'name' => 'Televisions',
            'slug' => 'television',
            'descriptions' =>
                'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi, obcaecati.',
        ]);

        CategoryProduct::create([
            'name' => 'Home Appliance',
            'slug' => 'home-appliance',
            'descriptions' =>
                'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi, obcaecati.',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fintech;

class FintechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fintech::create([
            'name' => 'Jenius',
            'slug' => 'jenius',
            'descriptions' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum dignissimos in error exercitationem aliquam quisquam.',
        ])
            ->acountfintech()
            ->create([
                'name' => 'flexy cash',
                'slug' => 'jenius-flexy-cash',
                'number' => 93333999,
            ]);

        Fintech::create([
            'name' => 'Bank Central Asia',
            'slug' => 'bca',
            'descriptions' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum dignissimos in error exercitationem aliquam quisquam.',
        ])
            ->acountfintech()
            ->create([
                'name' => 'Batman Card',
                'slug' => 'batman-card',
                'number' => 93333999,
            ]);

        Fintech::create([
            'name' => 'Bank DBS',
            'slug' => 'bbs',
            'descriptions' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum dignissimos in error exercitationem aliquam quisquam.',
        ])
            ->acountfintech()
            ->create([
                'name' => 'dbs Card',
                'slug' => 'dbs-card',
                'number' => 93333999,
            ]);

        Fintech::create([
            'name' => 'Bank bni',
            'slug' => 'bni',
            'descriptions' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum dignissimos in error exercitationem aliquam quisquam.',
        ])
            ->acountfintech()
            ->create([
                'name' => 'Bni Card',
                'slug' => 'bni-card',
                'number' => 93333999,
            ]);

        Fintech::create([
            'name' => 'Bank CIMB',
            'slug' => 'cimb',
            'descriptions' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum dignissimos in error exercitationem aliquam quisquam.',
        ])
            ->acountfintech()
            ->create([
                'name' => 'Cimb Syariah',
                'slug' => 'cimb-syariah',
                'number' => 93333999,
            ]);

        Fintech::create([
            'name' => 'Bank BRI',
            'slug' => 'bri',
            'descriptions' =>
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum dignissimos in error exercitationem aliquam quisquam.',
        ])
            ->acountfintech()
            ->create([
                'name' => 'Tokopedia Card',
                'slug' => 'tokopedia-card',
                'number' => 93333999,
            ]);
    }
}

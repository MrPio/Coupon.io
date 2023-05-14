<?php

namespace Database\Seeders;

use App\Models\Resources\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'name' => 'Amazon',
                'place' => 'Via San Petrarca 12',
                'logo' => 'amazon.png',
                'url' => 'https://www.amazon.it/',
                'color' => '#ffffff',
                'description' => fake()->text()
            ],
            [
                'name' => 'Conad',
                'place' => 'Via San Petrarca 12',
                'logo' => 'conad.png',
                'url' => 'https://spesaonline.conad.it/',
                'color' => '#ffffff',
                'description' => fake()->text()
            ],
            [
                'name' => 'Eurospin',
                'place' => 'Via San Petrarca 12',
                'logo' => 'eurospin.webp',
                'url' => 'https://www.eurospin.it/',
                'color' => '#ffffff',
                'description' => fake()->text()
            ],
            [
                'name' => 'LIDL',
                'place' => 'Via San Petrarca 12',
                'logo' => 'lidl.png',
                'url' => 'https://www.lidl.it/',
                'color' => '#fff100',
                'description' => fake()->text()
            ],
            [
                'name' => 'Media World',
                'place' => 'Via San Petrarca 12',
                'logo' => 'media_world.png',
                'url' => 'https://www.mediaworld.it/',
                'color' => '#ffffff',
                'description' => fake()->text()
            ],
            [
                'name' => 'Si con te',
                'place' => 'Via San Petrarca 12',
                'logo' => 'si.png',
                'url' => 'http://www.siconte.it/',
                'color' => '#ffffff',
                'description' => fake()->text()
            ],
            [
                'name' => 'Spotify',
                'place' => 'Via San Petrarca 12',
                'logo' => 'spotify.png',
                'url' => 'https://www.spotify.com/',
                'color' => '#190b10',
                'description' => fake()->text()
            ],
            [
                'name' => 'Unieuro',
                'place' => 'Via San Petrarca 12',
                'logo' => 'unieuro.webp',
                'url' => 'https://www.unieuro.it/',
                'color' => '#0d1d41',
                'description' => fake()->text()
            ]
        ];
        foreach ($companies as $company){
            Company::create($company);
        }
    }
}

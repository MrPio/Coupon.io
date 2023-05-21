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
                'type'=>'S.p.a.',
                'url' => 'https://www.amazon.it/',
                'color' => '#ffffff',
                'description' => fake()->text().fake()->text().fake()->text(),
                'featured'=>rand(0, 1) < 0.5,
            ],
            [
                'name' => 'Conad',
                'place' => 'Via San Petrarca 12',
                'logo' => 'conad.png',
                'type'=>'S.r.l.',
                'url' => 'https://spesaonline.conad.it/',
                'color' => '#fff200',
                'description' => fake()->text().fake()->text().fake()->text(),
                'featured'=>rand(0, 1) < 0.5,
            ],
            [
                'name' => 'Eurospin',
                'place' => 'Via San Petrarca 12',
                'logo' => 'eurospin.png',
                'type'=>'S.p.a.',
                'url' => 'https://www.eurospin.it/',
                'color' => '#005cb9',
                'description' => fake()->text().fake()->text().fake()->text(),
                'featured'=>rand(0, 1) < 0.5,
            ],
            [
                'name' => 'LIDL',
                'place' => 'Via San Petrarca 12',
                'logo' => 'lidl.png',
                'type'=>'S.n.c.',
                'url' => 'https://www.lidl.it/',
                'color' => '#1c4fab',
                'description' => fake()->text().fake()->text().fake()->text(),
                'featured'=>rand(0, 1) < 0.5,
            ],
            [
                'name' => 'Media World',
                'place' => 'Via San Petrarca 12',
                'logo' => 'media_world.png',
                'type'=>'S.p.a.',
                'url' => 'https://www.mediaworld.it/',
                'color' => '#e61103',
                'description' => fake()->text().fake()->text().fake()->text(),
                'featured'=>rand(0, 1) < 0.5,
            ],
            [
                'name' => 'Si con te',
                'place' => 'Via San Petrarca 12',
                'logo' => 'si.png',
                'type'=>'S.p.a.',
                'url' => 'http://www.siconte.it/',
                'color' => '#dc0812',
                'description' => fake()->text().fake()->text().fake()->text(),
                'featured'=>rand(0, 1) < 0.5,
            ],
            [
                'name' => 'Spotify',
                'place' => 'Via San Petrarca 12',
                'logo' => 'spotify.png',
                'type'=>'S.n.c.',
                'url' => 'https://www.spotify.com/',
                'color' => '#190b10',
                'description' => fake()->text().fake()->text().fake()->text(),
                'featured'=>rand(0, 1) < 0.5,
            ],
            [
                'name' => 'Unieuro',
                'place' => 'Via San Petrarca 12',
                'logo' => 'unieuro.webp',
                'type'=>'S.p.a.',
                'url' => 'https://www.unieuro.it/',
                'color' => '#0d1d41',
                'description' => fake()->text().fake()->text().fake()->text(),
                'featured'=>rand(0, 1) < 0.5,
            ]
        ];
        foreach ($companies as $company){
            Company::create($company);
        }
    }
}

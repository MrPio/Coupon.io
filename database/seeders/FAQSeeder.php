<?php

namespace Database\Seeders;

use App\Models\Resources\FAQ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'question' => 'Domanda numero 1',
                'answer' => 'Risposta numero 1'
            ],
            [
                'question' => 'Domanda numero 2',
                'answer' => 'Risposta numero 2'
            ],
            [
                'question' => 'Domanda numero 3',
                'answer' => 'Risposta numero 3'
            ],
        ];
        foreach ($faqs as $faq){
            FAQ::create($faq);
        }
    }
}

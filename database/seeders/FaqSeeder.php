<?php

namespace Database\Seeders;

use App\Models\Resources\FAQ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
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
                'question' => 'Che cos\'è un coupon',
                'answer' => ' Un coupon è un documento o un codice promozionale che offre uno sconto o un vantaggio speciale su un prodotto o un servizio specifico.'
            ],
            [
                'question' => 'Posso condividere i coupon con i miei amici',
                'answer' => ' Certamente! Ti incoraggiamo a condividere i coupon che trovi sul nostro sito con i tuoi amici e familiari. Più persone potranno beneficiare degli sconti e delle offerte speciali.'
            ],
            [
                'question' => ' I coupon sul vostro sito sono validi',
                'answer' => 'Ci impegniamo a fornire coupon validi e aggiornati, ma la validità dipende dalle politiche dei negozi e dei fornitori. Alcuni coupon potrebbero avere una data di scadenza, limitazioni territoriali o restrizioni specifiche. Assicurati di leggere attentamente i dettagli e i termini di utilizzo di ciascun coupon.'
            ],
        ];
        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

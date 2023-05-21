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
                'answer' => ' Un coupon è un documento stampabile che permette di usufruire di un\' offerta su 
                un prodotto specifico.'
            ],
            [
                'question' => "Come posso acquisire un coupon",
                'answer' => "Per poter acquisire un coupon è necessario registrarsi e accedere al proprio account. 
                Una volta fatto ciò è possibile sfogliare il catalogo e selezionare la promozione di interesse per 
                poterne acquisire il relativo coupon. Quest'ultimo può essere poi reperito sotto forma di documento 
                stampabile nella propria pagina utente. ",
            ],
            [
                'question' => "Ci sono delle limitazioni per poter utilizzare un coupon",
                'answer' => "Si. Per poter acquisire un coupon è necessario disporre di un account valido ed essere 
                autenticati al sito. Inoltre non è possibile acquisire il coupon di una promozione al seguito 
                della scadenza della stessa oppure a seguito del termine della disponibilità. ",
            ],
            [
                'question' => "In che modo posso cercare le promozioni di mio interesse",
                'answer' => "Sfogliando il catalogo è possibile selezionare sia l'azienda che la tipologia della promozione 
            di proprio interesse. Inoltre è possibile filtrare il prodotto al quale la promozione di interesse è riferita.",
            ],
            [
                'question' => "Dove posso trovare la lista delle aziende delle quali posso acquisire coupon",
                'answer' => "Nella pagina dedicata è possibile trovare una lista di tutte le aziende che collaborano con noi. 
                È possibile inoltre visualizzare le informazioni relative alla stessa selezionandone una.",

            ],
            [
                'question' => "È possibile specificare una categoria di interesse per le promozioni",
                'answer' => "Certamente. Nella pagina dedicata è possibile trovare una lista di tutte le categorie delle promozioni che il nostro catalogo dispone. Selezionandone una verrà filtrato il catalogo mostrando solo le promozioni di quella categoria.",

            ],
                [
                    'question' => 'Posso condividere i coupon con i miei amici',
                    'answer' => ' Certamente! Ti incoraggiamo a condividere i coupon che trovi sul nostro sito con i tuoi amici e familiari. Più persone potranno beneficiare degli sconti e delle offerte speciali.'
                ],
//            [
//                'question' => 'I coupon sul vostro sito sono validi',
//                'answer' => 'Ci impegniamo a fornire coupon validi e aggiornati, ma la validità dipende dalle politiche dei negozi e dei fornitori. Alcuni coupon potrebbero avere una data di scadenza, limitazioni territoriali o restrizioni specifiche. Assicurati di leggere attentamente i dettagli e i termini di utilizzo di ciascun coupon.'
//            ],
        ];
        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

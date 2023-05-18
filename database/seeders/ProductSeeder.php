<?php

namespace Database\Seeders;

use App\Models\Resources\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Dell Chromebook 11.6"',
                'price' => 141.23,
                'description' => 'Dell Chromebook 11.6 Laptop Computer Intel Dual Core 4GB RAM 16GB SSD WiFi HDMI Dell Chromebook 11.6 Laptop Computer Intel Dual Core 4GB RAM 16GB SSD WiFi HDMI',
                'image_path'=>'https://m.media-amazon.com/images/I/61f10LqkJtL._AC_SX679_.jpg',
                'url'=>'https://www.amazon.it/Dell-Chromebook-Laptop-Computer-Intel/dp/B099FKLGZD/ref=sr_1_1?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=2QTMHFPL7UQDB&keywords=Dell+Chromebook+11.6&qid=1684070925&sprefix=dell+chromebook+11.6%2Caps%2C254&sr=8-1'
            ],
            [
                'name' => 'Apple MacBook Air 13"',
                'price' => 836.78,
                'description' => 'Ti presentiamo il nuovo MacBook Air: il nostro portatile più sottile e leggero, completamente trasformato dal chip Apple M1. CPU fino a 3,5 volte più veloce. GPU fino a 5 volte più scattante. Il Neural Engine più evoluto di sempre, che assicura performance di machine learning fino a 9 volte migliori. Un’autonomia che su un MacBook Air non si era mai vista. E una tecnologia silenziosa, perché senza ventola. Ha una potenza senza precedenti, ed è pronto a seguirti ovunque.',
                'image_path'=>'https://m.media-amazon.com/images/I/71EbycNfD4L._AC_SL1500_.jpg',
                'url'=>'https://www.amazon.it/2022-Apple-Portatile-MacBook-chip/dp/B0B3CLKQX8/ref=sr_1_1_sspa?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=16IZ2MFL7M6R8&keywords=Apple+MacBook+Air+13&qid=1684071017&sprefix=profumo%2Caps%2C305&sr=8-1-spons&sp_csd=d2lkZ2V0TmFtZT1zcF9hdGY&psc=1'

            ],

            [
                'name' => 'Davidoff Cool Water Eau De Toilette',
                'price' => 29.56,
                'description' => 'Prova Cool Water Eau de Toilette Uomo di Davidoff. Scopri la fragranza marina da uomo per eccellenza, ispirata alla freschezza dell’oceano. Cool Water, l’essenza aromatica della vitalità|della potenza e della seduzione maschile.',
                'image_path'=>'https://m.media-amazon.com/images/I/21Anzq8ybJL._AC_.jpg',
                'url'=>'https://www.amazon.it/Davidoff-Cool-Water-Toilette-Uomo/dp/B0009OAHBY/ref=sr_1_4_sspa?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=1VZ3ZR0BYH1X5&keywords=profumo&qid=1684070714&sprefix=profumo%2Caps%2C138&sr=8-4-spons&sp_csd=d2lkZ2V0TmFtZT1zcF9hdGY&psc=1'
            ],
            [
                'name' => 'Dermomed Profumo',
                'price' => 2.30,
                'description' => ' Profumo al talco e iris per una atmosfera stimolante per i tuoi sensi. ',
                'image_path'=>'https://m.media-amazon.com/images/I/51HpKew-q0L._AC_SL1400_.jpg',
                'url'=>'https://www.amazon.it/Dermomed-Profumo-Talco-Iris-100-ml/dp/B012T226Y4/ref=sr_1_6?__mk_it_IT=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=1VZ3ZR0BYH1X5&keywords=profumo&qid=1684070714&sprefix=profumo%2Caps%2C138&sr=8-6'
            ],









            [
                'name' => 'ARZOPA Monitor portatile',
                'price' => 199.99,
                'description' => "Monitor portatile Full HD 1080p: il monitor portatile ARZOPA ha una risoluzione Full HD di 1920 x 1080. Angolo di visione completo di 178°, rapporto di contrasto 1000:1, spazio colore 72%, rapporto schermo 16:9, 320cd/? La luminosità e la frequenza di aggiornamento di 60 Hz mostrano l'immagine reale del gioco/scena/lavoro in modo perfetto e veloce. La tecnologia del filtro della luce blu mantiene gli occhi dall'affaticamento. ",
                'image_path'=>'https://m.media-amazon.com/images/I/71hpsk5gGrL._AC_SY450_.jpg',
                'url'=>'https://www.amazon.it/Monitor-portatile-monitor-ARZOPA-1920x1080/dp/B092KKLH93?pf_rd_r=JF2BE61H4NSJJH83RE01&pf_rd_t=Events&pf_rd_i=deals&pf_rd_p=e4fe9095-5e54-42d6-8cf4-f93d7c666c98&pf_rd_s=slot-17&ref=dlx_deals_gd_dcl_img_3_a2902ea6_dt_sl17_98'
            ],            [
                'name' => 'Blackview Smartwatch',
                'price' =>  54.99,
                'description' => '  2021 nuovo orologio intelligente touch a schermo intero da 1,3 pollici per uomini e donne. Progettato per i clienti che cercano aspetto, funzionalità ed esercizio fisico, tracker della salute / notifica di messaggi / assistenza personale / modalità sport / impermeabile 5ATM / aspetto elegante ',
                'image_path'=>'https://m.media-amazon.com/images/I/61AAMqPDPuL._AC_SX522_.jpg',
                'url'=>'https://www.amazon.it/Blackview-Smartwatch-Saturimetro-Cardiofrequenzimetro-Impermeabile/dp/B098T5NZT9?pf_rd_r=JF2BE61H4NSJJH83RE01&pf_rd_t=Events&pf_rd_i=deals&pf_rd_p=e4fe9095-5e54-42d6-8cf4-f93d7c666c98&pf_rd_s=slot-17&ref=dlx_deals_gd_dcl_img_19_3a319475_dt_sl17_98'
            ],          [
                'name' => 'Abboos Sneakers ',
                'price' => 35.99,
                'description' => 'Con il design semplice ed elegante, del Abboos la selezione i materiali morbidi, confortevoli e durevoli di alta qualità, le scarpe ginnastica donna leggere e traspiranti ne valgono la pena. I tuoi piedi respirano liberamente quando corri o cammini, permettendoti di dimenticare completamente i tuoi piedi e concentrarti sui punti in cui i tuoi piedi non possono andare. Prima di arrivare alla fine, ogni passo sarà pieno di vitalità. ',
                'image_path'=>'https://m.media-amazon.com/images/I/7122Z5uCDjL._AC_UY500_.jpg',
                'url'=>'https://www.amazon.it/Abboos-Ginnastica-Respirabile-Camminata-Passeggio/dp/B0BG1K4JS6?pf_rd_r=JF2BE61H4NSJJH83RE01&pf_rd_t=Events&pf_rd_i=deals&pf_rd_p=e4fe9095-5e54-42d6-8cf4-f93d7c666c98&pf_rd_s=slot-17&ref=dlx_deals_gd_dcl_img_28_aa7836d9_dt_sl17_98'
            ],            [
                'name' => 'Leather Honey Balsamo ',
                'price' => 35.95,
                'description' => "POTENTE BALSAMO PER PULIZIA PELLE AUTO: Leather Honey penetra in profondità per proteggere la pelle nuova e rigenerare la pelle arida e vecchia. Questo balsamo atossico per pelle e cuoio non contiene silicone, solventi o sostanze di origine animale. Non è appiccicoso ed è completamente inodore. Proteggi tutto l'anno la pelle da neve e pioggia con la nostra formula idrorepellente ",
                'image_path'=>'https://m.media-amazon.com/images/I/516ej6vg9LL._AC_SX425_.jpg',
                'url'=>'https://www.amazon.it/Leather-Honey-Protegge-Ringiovanisce-Prodotti/dp/B003IS3HV0?pf_rd_r=JF2BE61H4NSJJH83RE01&pf_rd_t=Events&pf_rd_i=deals&pf_rd_p=e4fe9095-5e54-42d6-8cf4-f93d7c666c98&pf_rd_s=slot-17&ref=dlx_deals_gd_dcl_img_35_1c7bd540_dt_sl17_98&th=1'
            ],
        ];
        foreach ($products as $product){
            Product::create($product);
        }
    }
}

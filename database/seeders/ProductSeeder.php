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
                'image_path'=>'https://m.media-amazon.com/images/G/29/apparel/rcxgs/tile._CB483369964_.gif',
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
        ];
        foreach ($products as $product){
            Product::create($product);
        }
    }
}

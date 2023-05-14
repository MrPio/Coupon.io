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
            ],
            [
                'name' => 'Apple MacBook Air 13"',
                'price' => 836.78,
                'description' => 'Ti presentiamo il nuovo MacBook Air: il nostro portatile più sottile e leggero, completamente trasformato dal chip Apple M1. CPU fino a 3,5 volte più veloce. GPU fino a 5 volte più scattante. Il Neural Engine più evoluto di sempre, che assicura performance di machine learning fino a 9 volte migliori. Un’autonomia che su un MacBook Air non si era mai vista. E una tecnologia silenziosa, perché senza ventola. Ha una potenza senza precedenti, ed è pronto a seguirti ovunque.',
            ],
        ];
        foreach ($products as $product){
            Product::create($product);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Resources\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $records = [[
            'name' => 'Salute e Bellezza',
            'description' => 'Integratori e Vitamine
Prodotti Salute
Prodotti per il Viso',
            'image_path' => '168.webp',
            'background_color' => '#52aa5e',
        ], [
            'name' => 'Elettrodomestici',
            'description' => 'Condizionatori e Deumidificatori
Frigoriferi e Congelatori
Lavatrici e Asciugatrici',
            'image_path' => '146.webp',
            'background_color' => '#ffba08',
        ], [
            'name' => 'Casa e Giardino',
            'description' => 'Ferramenta
Macchine Giardinaggio
Arredamento da Esterni',
            'image_path' => '196.webp',
            'background_color' => '#3da5d9',
        ], [
            'name' => 'Moda',
            'description' => 'Sneakers e Scarpe Sportive
Abbigliamento Donna
Orologi da Polso',
            'image_path' => '101.webp',
            'background_color' => '#ff4438',
        ], [
            'name' => 'Telefonia',
            'description' => 'Cellulari e Smartphone
Smartwatch e Orologi Sportivi
Cover per Cellulari',
            'image_path' => '14.webp',
            'background_color' => '#17bebb',
        ], [
            'name' => 'Informatica',
            'description' => 'Notebook
Schede Grafiche
Tablet',
            'image_path' => '13.webp',
            'background_color' => '#2978a0',
        ], [
            'name' => 'Auto e Moto',
            'description' => 'Pneumatici per Auto
Accessori e Ricambi Auto
Accessori e Ricambi Moto e Scooter',
            'image_path' => '233.webp',
            'background_color' => '#52aa5e',
        ], [
            'name' => 'Prodotti per Animali',
            'description' => 'Alimenti Cani e Gatti
Articoli per Veterinaria
Accessori e Giochi Cani e Gatti',
            'image_path' => '246.webp',
            'background_color' => '#ffba08',
        ], [
            'name' => 'Vini, Bevande e Alimentari',
            'description' => 'Vini
Tè, Caffè, Solubili
Alcolici',
            'image_path' => '99.webp',
            'background_color' => '#3da5d9',
        ], [
            'name' => 'Sport e Tempo libero',
            'description' => 'Biciclette elettriche
Biciclette
Accessori Biciclette',
            'image_path' => '95.webp',
            'background_color' => '#ff4438',
        ], [
            'name' => 'Audio e Video',
            'description' => 'Televisori
Cuffie e Microfoni
Diffusori Audio',
            'image_path' => '16.webp',
            'background_color' => '#17bebb',
        ], [
            'name' => 'Giochi e Hobby',
            'description' => 'Console Giochi
Lego
Giocattoli',
            'image_path' => '83.webp',
            'background_color' => '#2978a0',
        ], [
            'name' => 'Infanzia',
            'description' => 'Passeggini e Trio
Cura del bambino
Alimenti per Infanzia',
            'image_path' => '258.webp',
            'background_color' => '#52aa5e',
        ], [
            'name' => 'Foto e Videocamere',
            'description' => 'Fotocamere
Obiettivi per Fotocamere
Accessori Fotografia',
            'image_path' => '15.webp',
            'background_color' => '#ffba08',
        ], [
            'name' => 'Ottica',
            'description' => 'Occhiali da Sole
Lenti a Contatto
Montature da vista',
            'image_path' => '87.webp',
            'background_color' => '#3da5d9',
        ], [
            'name' => 'Scuola e Ufficio',
            'description' => 'Scuola e Cancelleria
Arredamento per Ufficio
Articoli per Attività Commerciale',
            'image_path' => '360.webp',
            'background_color' => '#ff4438',
        ], [
            'name' => 'Articoli per Fumatori',
            'description' => 'Sigarette Elettroniche
Accessori per Fumatori
Liquidi per Sigarette Elettroniche',
            'image_path' => '20243.webp',
            'background_color' => '#17bebb',
        ], [
            'name' => 'Gioielli',
            'description' => 'Girocolli
Bracciali
Anelli',
            'image_path' => '113.webp',
            'background_color' => '#52aa5e',
        ], [
            'name' => 'Idee regalo e gadget',
            'description' => 'Bomboniere
Gadget personalizzabili
Cofanetti Regalo ed Esperienze',
            'image_path' => '20030.webp',
            'background_color' => '#ffba08',
        ], [
            'name' => 'Musica',
            'description' => 'Strumenti Musicali
Accessori per musica
Strumentazione per musica',
            'image_path' => '276.webp',
            'background_color' => '#3da5d9',
        ], [
            'name' => 'Libri, Musica e Film',
            'description' => 'Libri
Manuali e Dizionari
Film in DVD',
            'image_path' => '330.webp',
            'background_color' => '#ff4438',
        ], [
            'name' => 'Servizi',
            'description' => 'Biglietti, Concerti ed Eventi
Corsi di formazione',
            'image_path' => '284.webp',
            'background_color' => '#17bebb',
        ]];
        foreach ($records as $record) {
            Category::create($record);
        }
    }
}

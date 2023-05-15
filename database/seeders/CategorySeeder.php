<?php

namespace Database\Seeders;

use App\Models\Resources\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [[
            'title' => 'Salute e Bellezza',
            'subtitle' => 'Integratori e Vitamine
Prodotti Salute
Prodotti per il Viso',
            'image' => '168.webp',
            'color' => '#52aa5e',
        ], [
            'title' => 'Elettrodomestici',
            'subtitle' => 'Condizionatori e Deumidificatori
Frigoriferi e Congelatori
Lavatrici e Asciugatrici',
            'image' => '146.webp',
            'color' => '#ffba08',
        ], [
            'title' => 'Casa e Giardino',
            'subtitle' => 'Ferramenta
Macchine Giardinaggio
Arredamento da Esterni',
            'image' => '196.webp',
            'color' => '#3da5d9',
        ], [
            'title' => 'Moda',
            'subtitle' => 'Sneakers e Scarpe Sportive
Abbigliamento Donna
Orologi da Polso',
            'image' => '101.webp',
            'color' => '#ff4438',
        ], [
            'title' => 'Telefonia',
            'subtitle' => 'Cellulari e Smartphone
Smartwatch e Orologi Sportivi
Cover per Cellulari',
            'image' => '14.webp',
            'color' => '#17bebb',
        ], [
            'title' => 'Informatica',
            'subtitle' => 'Notebook
Schede Grafiche
Tablet',
            'image' => '13.webp',
            'color' => '#2978a0',
        ], [
            'title' => 'Auto e Moto',
            'subtitle' => 'Pneumatici per Auto
Accessori e Ricambi Auto
Accessori e Ricambi Moto e Scooter',
            'image' => '233.webp',
            'color' => '#52aa5e',
        ], [
            'title' => 'Prodotti per Animali',
            'subtitle' => 'Alimenti Cani e Gatti
Articoli per Veterinaria
Accessori e Giochi Cani e Gatti',
            'image' => '246.webp',
            'color' => '#ffba08',
        ], [
            'title' => 'Vini, Bevande e Alimentari',
            'subtitle' => 'Vini
Tè, Caffè, Solubili
Alcolici',
            'image' => '99.webp',
            'color' => '#3da5d9',
        ], [
            'title' => 'Sport e Tempo libero',
            'subtitle' => 'Biciclette elettriche
Biciclette
Accessori Biciclette',
            'image' => '95.webp',
            'color' => '#ff4438',
        ], [
            'title' => 'Audio e Video',
            'subtitle' => 'Televisori
Cuffie e Microfoni
Diffusori Audio',
            'image' => '16.webp',
            'color' => '#17bebb',
        ], [
            'title' => 'Giochi e Hobby',
            'subtitle' => 'Console Giochi
Lego
Giocattoli',
            'image' => '83.webp',
            'color' => '#2978a0',
        ], [
            'title' => 'Infanzia',
            'subtitle' => 'Passeggini e Trio
Cura del bambino
Alimenti per Infanzia',
            'image' => '258.webp',
            'color' => '#52aa5e',
        ], [
            'title' => 'Foto e Videocamere',
            'subtitle' => 'Fotocamere
Obiettivi per Fotocamere
Accessori Fotografia',
            'image' => '15.webp',
            'color' => '#ffba08',
        ], [
            'title' => 'Ottica',
            'subtitle' => 'Occhiali da Sole
Lenti a Contatto
Montature da vista',
            'image' => '87.webp',
            'color' => '#3da5d9',
        ], [
            'title' => 'Scuola e Ufficio',
            'subtitle' => 'Scuola e Cancelleria
Arredamento per Ufficio
Articoli per Attività Commerciale',
            'image' => '360.webp',
            'color' => '#ff4438',
        ], [
            'title' => 'Articoli per Fumatori',
            'subtitle' => 'Sigarette Elettroniche
Accessori per Fumatori
Liquidi per Sigarette Elettroniche',
            'image' => '20243.webp',
            'color' => '#17bebb',
        ], [
            'title' => 'Gioielli',
            'subtitle' => 'Girocolli
Bracciali
Anelli',
            'image' => '113.webp',
            'color' => '#52aa5e',
        ], [
            'title' => 'Idee regalo e gadget',
            'subtitle' => 'Bomboniere
Gadget personalizzabili
Cofanetti Regalo ed Esperienze',
            'image' => '20030.webp',
            'color' => '#ffba08',
        ], [
            'title' => 'Musica',
            'subtitle' => 'Strumenti Musicali
Accessori per musica
Strumentazione per musica',
            'image' => '276.webp',
            'color' => '#3da5d9',
        ], [
            'title' => 'Libri, Musica e Film',
            'subtitle' => 'Libri
Manuali e Dizionari
Film in DVD',
            'image' => '330.webp',
            'color' => '#ff4438',
        ], [
            'title' => 'Servizi',
            'subtitle' => 'Biglietti, Concerti ed Eventi
Corsi di formazione',
            'image' => '284.webp',
            'color' => '#17bebb',
        ]];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

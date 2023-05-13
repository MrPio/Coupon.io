<?php

namespace Database\Seeders;

use App\Models\Resources\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $records = [[
            'nome' => 'Salute e Bellezza',
            'descrizione' => 'Integratori e Vitamine
Prodotti Salute
Prodotti per il Viso',
            'immagine' => '168.webp',
            'color' => '#52aa5e',
        ], [
            'nome' => 'Elettrodomestici',
            'descrizione' => 'Condizionatori e Deumidificatori
Frigoriferi e Congelatori
Lavatrici e Asciugatrici',
            'immagine' => '146.webp',
            'color' => '#ffba08',
        ], [
            'nome' => 'Casa e Giardino',
            'descrizione' => 'Ferramenta
Macchine Giardinaggio
Arredamento da Esterni',
            'immagine' => '196.webp',
            'color' => '#3da5d9',
        ], [
            'nome' => 'Moda',
            'descrizione' => 'Sneakers e Scarpe Sportive
Abbigliamento Donna
Orologi da Polso',
            'immagine' => '101.webp',
            'color' => '#ff4438',
        ], [
            'nome' => 'Telefonia',
            'descrizione' => 'Cellulari e Smartphone
Smartwatch e Orologi Sportivi
Cover per Cellulari',
            'immagine' => '14.webp',
            'color' => '#17bebb',
        ], [
            'nome' => 'Informatica',
            'descrizione' => 'Notebook
Schede Grafiche
Tablet',
            'immagine' => '13.webp',
            'color' => '#2978a0',
        ], [
            'nome' => 'Auto e Moto',
            'descrizione' => 'Pneumatici per Auto
Accessori e Ricambi Auto
Accessori e Ricambi Moto e Scooter',
            'immagine' => '233.webp',
            'color' => '#52aa5e',
        ], [
            'nome' => 'Prodotti per Animali',
            'descrizione' => 'Alimenti Cani e Gatti
Articoli per Veterinaria
Accessori e Giochi Cani e Gatti',
            'immagine' => '246.webp',
            'color' => '#ffba08',
        ], [
            'nome' => 'Vini, Bevande e Alimentari',
            'descrizione' => 'Vini
Tè, Caffè, Solubili
Alcolici',
            'immagine' => '99.webp',
            'color' => '#3da5d9',
        ], [
            'nome' => 'Sport e Tempo libero',
            'descrizione' => 'Biciclette elettriche
Biciclette
Accessori Biciclette',
            'immagine' => '95.webp',
            'color' => '#ff4438',
        ], [
            'nome' => 'Audio e Video',
            'descrizione' => 'Televisori
Cuffie e Microfoni
Diffusori Audio',
            'immagine' => '16.webp',
            'color' => '#17bebb',
        ], [
            'nome' => 'Giochi e Hobby',
            'descrizione' => 'Console Giochi
Lego
Giocattoli',
            'immagine' => '83.webp',
            'color' => '#2978a0',
        ], [
            'nome' => 'Infanzia',
            'descrizione' => 'Passeggini e Trio
Cura del bambino
Alimenti per Infanzia',
            'immagine' => '258.webp',
            'color' => '#52aa5e',
        ], [
            'nome' => 'Foto e Videocamere',
            'descrizione' => 'Fotocamere
Obiettivi per Fotocamere
Accessori Fotografia',
            'immagine' => '15.webp',
            'color' => '#ffba08',
        ], [
            'nome' => 'Ottica',
            'descrizione' => 'Occhiali da Sole
Lenti a Contatto
Montature da vista',
            'immagine' => '87.webp',
            'color' => '#3da5d9',
        ], [
            'nome' => 'Scuola e Ufficio',
            'descrizione' => 'Scuola e Cancelleria
Arredamento per Ufficio
Articoli per Attività Commerciale',
            'immagine' => '360.webp',
            'color' => '#ff4438',
        ], [
            'nome' => 'Articoli per Fumatori',
            'descrizione' => 'Sigarette Elettroniche
Accessori per Fumatori
Liquidi per Sigarette Elettroniche',
            'immagine' => '20243.webp',
            'color' => '#17bebb',
        ], [
            'nome' => 'Gioielli',
            'descrizione' => 'Girocolli
Bracciali
Anelli',
            'immagine' => '113.webp',
            'color' => '#52aa5e',
        ], [
            'nome' => 'Idee regalo e gadget',
            'descrizione' => 'Bomboniere
Gadget personalizzabili
Cofanetti Regalo ed Esperienze',
            'immagine' => '20030.webp',
            'color' => '#ffba08',
        ], [
            'nome' => 'Musica',
            'descrizione' => 'Strumenti Musicali
Accessori per musica
Strumentazione per musica',
            'immagine' => '276.webp',
            'color' => '#3da5d9',
        ], [
            'nome' => 'Libri, Musica e Film',
            'descrizione' => 'Libri
Manuali e Dizionari
Film in DVD',
            'immagine' => '330.webp',
            'color' => '#ff4438',
        ], [
            'nome' => 'Servizi',
            'descrizione' => 'Biglietti, Concerti ed Eventi
Corsi di formazione',
            'immagine' => '284.webp',
            'color' => '#17bebb',
        ]];
        foreach ($records as $record) {
            Categoria::create($record);
        }
    }
}

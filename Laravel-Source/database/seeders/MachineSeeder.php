<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    public function run(): void
    {
        Machine::create([
            'title' => 'SCM Formula S 35',
            'category' => 'Zagen',
            'brand' => 'SCM',
            'condition' => 'Gebruikt',
            'year' => '2021',
            'material' => 'Hout',
            'stock_status' => 'op_voorraad',
            'short_description' => 'Professionele zaagmachine voor nauwkeurig en betrouwbaar zaagwerk.',
            'description' => 'Deze SCM zaagmachine is geschikt voor professionele houtbewerking en dagelijks gebruik in een werkplaats.',
            'extra_info' => '<h3>Extra informatie</h3><p>Deze machine verkeert in nette staat en is direct inzetbaar.</p><ul><li>380V aansluiting</li><li>Transport mogelijk</li><li>Meer foto\'s op aanvraag</li></ul>',
            'is_active' => true,
        ]);

        Machine::create([
            'title' => 'Altendorf F45',
            'category' => 'Zagen',
            'brand' => 'Altendorf',
            'condition' => 'Gebruikt',
            'year' => '2019',
            'material' => 'Hout',
            'stock_status' => 'op_voorraad',
            'short_description' => 'Formaatzaag voor professioneel gebruik.',
            'description' => 'Nette gebruikte formaatzaag met sterke constructie en praktische bediening.',
            'extra_info' => '<h3>Extra informatie</h3><p>Deze machine verkeert in nette staat en is direct inzetbaar.</p><ul><li>380V aansluiting</li><li>Transport mogelijk</li><li>Meer foto\'s op aanvraag</li></ul>',
            'is_active' => true,
        ]);

        Machine::create([
            'title' => 'Biesse Rover CNC',
            'category' => 'CNC-bewerking',
            'brand' => 'Biesse',
            'condition' => 'Gebruikt',
            'year' => '2020',
            'material' => 'Hout',
            'stock_status' => 'op_voorraad',
            'short_description' => 'CNC-bewerkingscentrum voor houtbewerking.',
            'description' => 'CNC-machine geschikt voor seriematig werk en nauwkeurige bewerkingen.',
            'extra_info' => '<h2>Nieuwe functionaliteit opgebouwd</h2><p>Dit onderdeel is net toegevoegd aan de website en is bedoeld om de nieuwe opbouw, indeling en werking goed te kunnen testen. De tekst is bewust wat langer gemaakt, zodat duidelijk zichtbaar wordt hoe de pagina omgaat met meerdere regels tekst, langere omschrijvingen en bredere contentblokken.</p><p>Hiermee kunnen we controleren of de layout netjes blijft werken op desktop, tablet en mobiel.</p><p>Deze tekst kan later eenvoudig worden vervangen door echte inhoud.</p>',
            'is_active' => true,
        ]);
    }
}
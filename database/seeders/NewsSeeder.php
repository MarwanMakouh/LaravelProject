<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsItems = [
            [
                'title' => 'Welkom bij GamePortal!',
                'content' => 'We zijn verheugd om GamePortal te lanceren, jouw nieuwe bestemming voor gaming nieuws, reviews en community discussies. Ontdek de nieuwste games, deel je ervaringen en verbind met andere gamers!',
                'image_url' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?w=800',
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'Nieuwe Features Toegevoegd',
                'content' => 'We hebben spannende nieuwe features toegevoegd aan het platform! Bekijk profielpagina\'s van andere gebruikers, deel je favoriete games en laat comments achter op games. Veel plezier met ontdekken!',
                'image_url' => 'https://images.unsplash.com/photo-1552820728-8b83bb6b773f?w=800',
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Community Groeit Snel',
                'content' => 'Onze gaming community groeit elke dag! Bedankt aan alle gebruikers die zich hebben aangemeld en actief deelnemen. Blijf jullie ervaringen delen en help mee om deze community geweldig te maken.',
                'image_url' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=800',
                'published_at' => Carbon::now()->subDays(3),
            ],
            [
                'title' => 'Top 10 Meest Besproken Games',
                'content' => 'Deze maand hebben we geweldige discussies gezien over tal van games. Van indie parels tot AAA blockbusters, onze community heeft over alles gepraat. Bekijk welke games het meest besproken worden!',
                'image_url' => 'https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?w=800',
                'published_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'Aankomende Features Preview',
                'content' => 'Binnenkort komen er nog meer spannende features naar GamePortal! Denk aan persoonlijke game lijsten, vrienden systeem, achievements en meer. Blijf op de hoogte voor updates!',
                'image_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=800',
                'published_at' => Carbon::now(),
            ],
        ];

        foreach ($newsItems as $item) {
            News::create($item);
        }
    }
}

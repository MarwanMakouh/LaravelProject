<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            // Algemeen
            [
                'question' => 'Wat is GamePortal?',
                'answer' => 'GamePortal is een online platform waar gamers samenkomen om de nieuwste games te ontdekken, reviews te lezen, en deel te nemen aan community discussies. We bieden uitgebreide game informatie, nieuws updates, en een actieve community van gaming enthousiastelingen.',
                'category' => 'Algemeen',
                'order' => 1,
            ],
            [
                'question' => 'Is GamePortal gratis te gebruiken?',
                'answer' => 'Ja, GamePortal is volledig gratis te gebruiken! Je kunt gratis een account aanmaken en toegang krijgen tot alle features zoals game informatie, community posts, en profiel aanpassingen.',
                'category' => 'Algemeen',
                'order' => 2,
            ],
            [
                'question' => 'Welke browsers worden ondersteund?',
                'answer' => 'GamePortal werkt het beste op moderne browsers zoals Google Chrome, Firefox, Safari, en Microsoft Edge. We raden aan om altijd de nieuwste versie van je browser te gebruiken voor de beste ervaring.',
                'category' => 'Algemeen',
                'order' => 3,
            ],

            // Account
            [
                'question' => 'Hoe maak ik een account aan?',
                'answer' => 'Klik op de "Registreren" knop in de navigatiebalk, vul je naam, email en wachtwoord in, en bevestig je email adres. Na verificatie kun je direct beginnen met het gebruik van GamePortal!',
                'category' => 'Account',
                'order' => 1,
            ],
            [
                'question' => 'Kan ik mijn gebruikersnaam veranderen?',
                'answer' => 'Ja! Ga naar je profiel, klik op "Profiel Bewerken" en je kunt daar je username, geboortedatum, profielfoto en "over mij" sectie aanpassen.',
                'category' => 'Account',
                'order' => 2,
            ],
            [
                'question' => 'Ik ben mijn wachtwoord vergeten, wat nu?',
                'answer' => 'Geen probleem! Klik op de "Login" pagina op "Wachtwoord vergeten?". Vul je email adres in en we sturen je een link om je wachtwoord te resetten.',
                'category' => 'Account',
                'order' => 3,
            ],
            [
                'question' => 'Hoe verwijder ik mijn account?',
                'answer' => 'Neem contact met ons op via het contactformulier en wij helpen je met het verwijderen van je account. We vinden het jammer om je te zien gaan!',
                'category' => 'Account',
                'order' => 4,
            ],

            // Games
            [
                'question' => 'Waar komt de game informatie vandaan?',
                'answer' => 'We gebruiken de RAWG Video Games Database API om actuele en uitgebreide informatie over games te tonen, inclusief ratings, screenshots, beschrijvingen en release data.',
                'category' => 'Games',
                'order' => 1,
            ],
            [
                'question' => 'Hoe kan ik games toevoegen aan mijn favorieten?',
                'answer' => 'Ga naar de detail pagina van een game en klik op de "Voeg toe aan favorieten" knop. Je favoriete games worden getoond op je profiel pagina, zichtbaar voor andere gebruikers.',
                'category' => 'Games',
                'order' => 2,
            ],
            [
                'question' => 'Kan ik reviews schrijven voor games?',
                'answer' => 'Momenteel kun je comments plaatsen op game pagina\'s om je mening te delen. Andere gebruikers kunnen ook comments achterlaten en zo ontstaat een discussie over de game.',
                'category' => 'Games',
                'order' => 3,
            ],
            [
                'question' => 'Hoe zoek ik naar specifieke games?',
                'answer' => 'Gebruik de zoekbalk in de navigatiebalk op de homepage. Type de naam van de game die je zoekt en de resultaten worden direct getoond.',
                'category' => 'Games',
                'order' => 4,
            ],

            // Community
            [
                'question' => 'Wat is de Community sectie?',
                'answer' => 'In de Community sectie kunnen gebruikers discussies starten over alles wat met gaming te maken heeft. Deel je ervaringen, vraag om tips, of praat over je favoriete games met andere gamers.',
                'category' => 'Community',
                'order' => 1,
            ],
            [
                'question' => 'Hoe maak ik een community post aan?',
                'answer' => 'Ga naar de Community pagina en klik op "Nieuwe Post Aanmaken". Geef je post een titel en schrijf je bericht. Andere gebruikers kunnen reageren op je post.',
                'category' => 'Community',
                'order' => 2,
            ],
            [
                'question' => 'Zijn er regels voor community posts?',
                'answer' => 'Ja, we vragen je om respectvol te zijn naar andere gebruikers, geen spam te posten, en om on-topic te blijven. Posts die deze regels overtreden kunnen worden verwijderd.',
                'category' => 'Community',
                'order' => 3,
            ],

            // Technisch
            [
                'question' => 'Waarom moet ik mijn email verifiëren?',
                'answer' => 'Email verificatie helpt ons om spam accounts te voorkomen en zorgt ervoor dat je je wachtwoord kunt resetten als je deze vergeet. Het is een belangrijke beveiligingsmaatregel.',
                'category' => 'Technisch',
                'order' => 1,
            ],
            [
                'question' => 'Werkt GamePortal op mobiele apparaten?',
                'answer' => 'Ja! GamePortal is volledig responsive en werkt prima op smartphones en tablets. Alle features zijn beschikbaar op elk apparaat.',
                'category' => 'Technisch',
                'order' => 2,
            ],
            [
                'question' => 'Ik heb een bug gevonden, waar kan ik dit melden?',
                'answer' => 'Bedankt voor het melden! Ga naar het Contact formulier en beschrijf het probleem zo gedetailleerd mogelijk. We zullen zo snel mogelijk antwoorden.',
                'category' => 'Technisch',
                'order' => 3,
            ],
        ];

        foreach ($faqs as $faq) {
            // Voeg is_published toe als niet aanwezig
            $faq['is_published'] = $faq['is_published'] ?? true;
            Faq::create($faq);
        }
    }
}

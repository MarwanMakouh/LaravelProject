<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Haal users op (uitgezonderd admin)
        $users = User::where('email', '!=', 'admin@ehb.be')
                     ->where('email', '!=', 'test@example.com')
                     ->get();

        if ($users->isEmpty()) {
            return;
        }

        $posts = [
            [
                'title' => 'Welke game speel jij momenteel?',
                'content' => 'Ik ben benieuwd wat iedereen momenteel speelt! Ik zit zelf helemaal in Elden Ring en het is geweldig. Wat zijn jullie favoriete games op dit moment?',
                'likes' => 15,
                'comments' => [
                    'Ik speel nu Baldur\'s Gate 3, het is echt een meesterwerk!',
                    'Cyberpunk 2077 na alle updates, veel beter dan bij launch.',
                    'Hogwarts Legacy is mijn current obsession!',
                ],
            ],
            [
                'title' => 'Tips voor beginners in Dark Souls?',
                'content' => 'Ik ben net begonnen met Dark Souls en het is behoorlijk uitdagend. Hebben jullie tips voor een beginner? Welke class is het beste om mee te starten?',
                'likes' => 23,
                'comments' => [
                    'Kies Knight class, makkelijkste voor beginners. En wees geduldig!',
                    'Leer de boss patterns, timing is alles in deze game.',
                    'Vergeet niet je shield te upgraden, helpt enorm in het begin.',
                ],
            ],
            [
                'title' => 'Beste indie games van 2024',
                'content' => 'Ik hou van indie games! Wat zijn jullie favoriete indie games die dit jaar zijn uitgekomen? Ik zoek nieuwe games om te spelen.',
                'likes' => 18,
                'comments' => [
                    'Hades 2 is fantastisch! Nog beter dan het eerste deel.',
                    'Probeer Hollow Knight Silksong als je van Metroidvanias houdt.',
                    'Dave the Diver is super verslavend!',
                ],
            ],
            [
                'title' => 'Gaming setup showcase',
                'content' => 'Laten we onze gaming setups delen! Ik heb net een nieuwe monitor gekocht en ben super blij ermee. Wat is jullie setup?',
                'likes' => 31,
                'comments' => [
                    'Dual monitor setup met RGB lighting, love it!',
                    'PS5 met een 55 inch OLED TV, gaming heaven.',
                    'Gaming laptop voor onderweg, werkt perfect.',
                ],
            ],
            [
                'title' => 'Multiplayer games om samen te spelen?',
                'content' => 'Ik zoek leuke multiplayer games om met vrienden te spelen. Liefst iets dat casual is maar ook competitief kan zijn. Suggesties?',
                'likes' => 27,
                'comments' => [
                    'Among Us is altijd leuk met vrienden!',
                    'Overcooked 2 voor chaotische co-op fun.',
                    'Rocket League is perfect, makkelijk te leren maar moeilijk te masteren.',
                ],
            ],
            [
                'title' => 'Beste RPG experiences',
                'content' => 'Ik ben op zoek naar RPG games met geweldige verhalen en karakterontwikkeling. Wat zijn jullie all-time favorite RPGs?',
                'likes' => 42,
                'comments' => [
                    'The Witcher 3 is nog steeds ongeëvenaard voor mij.',
                    'Final Fantasy VII Remake was een emotionele rollercoaster.',
                    'Mass Effect trilogy, vooral de character development is top!',
                ],
            ],
            [
                'title' => 'Horror games recommendations',
                'content' => 'Ik hou van horror games die echt eng zijn. Welke horror games moeten absoluut gespeeld worden?',
                'likes' => 19,
                'comments' => [
                    'Resident Evil Village is spannend en mooi!',
                    'Silent Hill 2 Remake komt er aan, kan niet wachten.',
                    'Outlast als je echt wilt schrikken!',
                ],
            ],
            [
                'title' => 'Gaming op een budget',
                'content' => 'Niet iedereen kan €70 per game uitgeven. Wat zijn goede budget games of waar vinden jullie de beste deals?',
                'likes' => 35,
                'comments' => [
                    'Steam sales zijn je beste vriend! Wishlist games en wacht op sales.',
                    'Xbox Game Pass is echt worth it, zoveel games voor weinig geld.',
                    'Epic Games geeft elke week gratis games weg!',
                ],
            ],
        ];

        foreach ($posts as $index => $postData) {
            $user = $users->random();

            $comments = $postData['comments'];
            unset($postData['comments']);

            $post = Community::create([
                'user_id' => $user->id,
                'title' => $postData['title'],
                'content' => $postData['content'],
                'likes' => $postData['likes'],
            ]);

            // Voeg comments toe aan de post
            foreach ($comments as $commentText) {
                $commentUser = $users->random();

                Comment::create([
                    'commentable_type' => Community::class,
                    'commentable_id' => $post->id,
                    'user_id' => $commentUser->id,
                    'author' => $commentUser->display_name,
                    'content' => $commentText,
                ]);
            }
        }
    }
}

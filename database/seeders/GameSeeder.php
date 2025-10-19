<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Comment;
use App\Models\User;
use App\Models\FavoriteGame;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Voegt populaire games toe aan de database met RAWG API IDs
     */
    public function run(): void
    {
        // Populaire games met hun RAWG ID en slug
        $games = [
            [
                'rawg_id' => 3328,
                'name' => 'The Witcher 3: Wild Hunt',
                'slug' => '3328-the-witcher-3-wild-hunt',
            ],
            [
                'rawg_id' => 3498,
                'name' => 'Grand Theft Auto V',
                'slug' => '3498-grand-theft-auto-v',
            ],
            [
                'rawg_id' => 4200,
                'name' => 'Portal 2',
                'slug' => '4200-portal-2',
            ],
            [
                'rawg_id' => 5286,
                'name' => 'Tomb Raider (2013)',
                'slug' => '5286-tomb-raider',
            ],
            [
                'rawg_id' => 58175,
                'name' => 'God of War',
                'slug' => '58175-god-of-war',
            ],
            [
                'rawg_id' => 28,
                'name' => 'Red Dead Redemption 2',
                'slug' => '28-red-dead-redemption-2',
            ],
            [
                'rawg_id' => 5679,
                'name' => 'The Elder Scrolls V: Skyrim',
                'slug' => '5679-the-elder-scrolls-v-skyrim',
            ],
            [
                'rawg_id' => 1030,
                'name' => 'Limbo',
                'slug' => '1030-limbo',
            ],
            [
                'rawg_id' => 13536,
                'name' => 'Portal',
                'slug' => '13536-portal',
            ],
            [
                'rawg_id' => 422,
                'name' => 'Terraria',
                'slug' => '422-terraria',
            ],
            [
                'rawg_id' => 3070,
                'name' => 'Fallout 4',
                'slug' => '3070-fallout-4',
            ],
            [
                'rawg_id' => 802,
                'name' => 'Borderlands 2',
                'slug' => '802-borderlands-2',
            ],
        ];

        // Haal users op voor comments en favorites
        $users = User::where('email', '!=', 'admin@ehb.be')
                     ->where('email', '!=', 'test@example.com')
                     ->get();

        foreach ($games as $gameData) {
            $game = Game::create($gameData);

            // Voeg random comments toe aan elke game
            if ($users->isNotEmpty()) {
                $numComments = rand(2, 5);

                $gameComments = [
                    'Dit is echt een meesterwerk! Een van de beste games die ik ooit heb gespeeld.',
                    'Geweldige graphics en gameplay. Zeer aan te raden!',
                    'Ik heb hier zoveel uren in gestoken en het is het helemaal waard.',
                    'De storyline is fantastisch. Kon niet stoppen met spelen!',
                    'Een must-play voor elke gamer. Absoluut iconisch.',
                    'Best game ooit! De muziek, het verhaal, alles klopt.',
                    'Ongelooflijk hoeveel detail er in zit. Respect voor de developers.',
                    'Na jaren speel ik dit nog steeds. Tijdloos!',
                    'De beste investering die ik ooit heb gedaan. 10/10',
                    'Perfecte game voor een weekend marathon. Zeer verslavend!',
                ];

                for ($i = 0; $i < $numComments; $i++) {
                    $user = $users->random();
                    $commentText = $gameComments[array_rand($gameComments)];

                    Comment::create([
                        'commentable_type' => Game::class,
                        'commentable_id' => $game->id,
                        'user_id' => $user->id,
                        'author' => $user->display_name,
                        'content' => $commentText,
                    ]);
                }

                // Voeg game toe aan favorites van random users
                $numFavorites = rand(1, min(3, $users->count()));
                $favoriteUsers = $users->random($numFavorites);

                foreach ($favoriteUsers as $user) {
                    FavoriteGame::create([
                        'user_id' => $user->id,
                        'game_id' => $game->id,
                    ]);
                }
            }
        }
    }
}

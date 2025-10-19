<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Gamer',
                'username' => 'johngamer',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'birthday' => Carbon::parse('1995-05-15'),
                'email_verified_at' => now(),
                'profile' => [
                    'about_me' => 'Passionate gamer sinds 2005. Ik hou van RPG\'s en strategy games. Altijd op zoek naar nieuwe gaming ervaringen!',
                ],
            ],
            [
                'name' => 'Sarah Player',
                'username' => 'sarahplayer',
                'email' => 'sarah@example.com',
                'password' => Hash::make('password'),
                'birthday' => Carbon::parse('1998-08-22'),
                'email_verified_at' => now(),
                'profile' => [
                    'about_me' => 'Indie game enthusiast. Ik speel graag creatieve en artistieke games. Favoriete genres: platformers en puzzels.',
                ],
            ],
            [
                'name' => 'Mike Controller',
                'username' => 'mikecontroller',
                'email' => 'mike@example.com',
                'password' => Hash::make('password'),
                'birthday' => Carbon::parse('1992-03-10'),
                'email_verified_at' => now(),
                'profile' => [
                    'about_me' => 'Competitieve gamer die vooral FPS en Battle Royale games speelt. Altijd klaar voor een uitdaging!',
                ],
            ],
            [
                'name' => 'Emma Joystick',
                'username' => 'emmajoystick',
                'email' => 'emma@example.com',
                'password' => Hash::make('password'),
                'birthday' => Carbon::parse('2000-11-30'),
                'email_verified_at' => now(),
                'profile' => [
                    'about_me' => 'Retro gaming fan! Ik verzamel oude consoles en speel graag klassieke games. Nintendo is mijn favoriet.',
                ],
            ],
            [
                'name' => 'Alex Quest',
                'username' => 'alexquest',
                'email' => 'alex@example.com',
                'password' => Hash::make('password'),
                'birthday' => Carbon::parse('1996-07-18'),
                'email_verified_at' => now(),
                'profile' => [
                    'about_me' => 'Open-world adventure lover. Ik besteed uren aan het verkennen van game werelden en het voltooien van side quests.',
                ],
            ],
        ];

        foreach ($users as $userData) {
            $profileData = $userData['profile'];
            unset($userData['profile']);

            $user = User::create($userData);

            UserProfile::create([
                'user_id' => $user->id,
                'about_me' => $profileData['about_me'],
            ]);
        }
    }
}

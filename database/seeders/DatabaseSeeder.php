<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. Eerst admin aanmaken
            AdminSeeder::class,

            // 2. Vervolgens reguliere users
            UserSeeder::class,

            // 3. Dan news articles en FAQs
            NewsSeeder::class,
            FaqSeeder::class,

            // 4. Games met comments (vereist users)
            GameSeeder::class,

            // 5. Community posts met comments (vereist users)
            CommunitySeeder::class,
        ]);

        $this->command->info('✅ Database succesvol gevuld met basis data!');
        $this->command->info('👤 Admin: admin@ehb.be / Password!321');
        $this->command->info('👤 Test users: john@example.com, sarah@example.com, mike@example.com, emma@example.com, alex@example.com');
        $this->command->info('🔑 Wachtwoord voor alle test users: password');
    }
}

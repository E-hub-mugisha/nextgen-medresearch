<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            ProgramSeeder::class,
            StoriesTableSeeder::class,
            ResourcesTableSeeder::class,
            EventsTableSeeder::class,
            ProjectsTableSeeder::class,
            MentorQuestionsSeeder::class,
            PartnersSeeder::class
        ]);
    }
}

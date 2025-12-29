<?php

namespace Database\Seeders;

use App\Models\MenteeProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MenteeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            // Create a user
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // default password
                'remember_token' => Str::random(10),
                'role' => 'mentee'
            ]);

            // Create mentee profile
            MenteeProfile::create([
                'user_id' => $user->id,
                'education_level' => fake()->randomElement(['Undergraduate', 'Graduate', 'Masters', 'PhD']),
                'research_goals' => fake()->paragraph(),
                'bio' => fake()->paragraph(2),
                'location' => fake()->city(),
                'image' => 'https://i.pravatar.cc/150?img=' . rand(1, 70), // random avatar
            ]);
        }
    }
}

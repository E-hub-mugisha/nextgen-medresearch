<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\MentorProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MentorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $expertiseAreas = [
            'Cardiology', 'Oncology', 'Public Health', 'Epidemiology',
            'Surgery', 'Pediatrics', 'Biomedical Research', 'AI in Health',
            'Pharmacy', 'Nursing Leadership'
        ];

        $countries = [
            'Rwanda', 'Kenya', 'Uganda', 'Tanzania',
            'Nigeria', 'South Africa', 'UK', 'USA', 'Canada'
        ];

        for ($i = 1; $i <= 15; $i++) {

            $user = User::create([
                'name' => $faker->name(),
                'email' => 'mentor'.$i.'@demo.com',
                'role' => 'mentor',
                'password' => Hash::make('password'),
            ]);

            MentorProfile::create([
                'user_id' => $user->id,
                'bio' => $faker->paragraph(4),
                'expertise' => $faker->randomElement($expertiseAreas),
                'country' => $faker->randomElement($countries),
                'available' => $faker->boolean(80), // 80% available
                'organization' => $faker->company(),
                'experience_years' => $faker->numberBetween(2, 25),
            ]);
        }

        echo "Mentor demo data seeded successfully.\n";
    }
}

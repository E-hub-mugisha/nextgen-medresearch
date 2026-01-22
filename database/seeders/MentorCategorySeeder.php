<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MentorCategory;
use Illuminate\Support\Str;

class MentorCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Clinical Research',
            'Research Methodology',
            'Publishing & Journals',
            'Data Analysis',
            'Ethics & Compliance',
            'Grant Writing',
            'Career Guidance',
            'Thesis & Dissertation',
        ];

        foreach ($categories as $name) {
            MentorCategory::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}

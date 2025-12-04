<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Research;
use App\Models\Category;
use Illuminate\Support\Str;

class ResearchSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure a category exists
        $category = Category::firstOrCreate(
            ['slug' => 'research-projects'],
            [
                'name' => 'Research Projects',
                'type' => 'research',
                'description' => 'All ongoing and published research projects.',
                'status' => 'active'
            ]
        );

        $researchItems = [
            [
                'title' => 'Road Safety & Post-Crash Care Analysis in Rwanda',
                'summary' => 'A study assessing emergency response efficiency and injury outcomes.',
            ],
            [
                'title' => 'Digital Mentorship Dashboard Pilot Evaluation',
                'summary' => 'Evaluating effectiveness of digital mentorship tools among clinicians.',
            ],
            [
                'title' => 'Medical Research Capacity in East Africa: A Situational Analysis',
                'summary' => 'Assessment of research barriers, mentorship gaps, and opportunities.',
            ]
        ];

        foreach ($researchItems as $item) {
            Research::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']) . '-' . time() . rand(10, 99),
                'category_id' => $category->id,
                'summary' => $item['summary'],
                'content' => fake()->paragraph(8),
                'status' => 'published',
                'featured' => true,
                'view_count' => rand(50, 500),
                'download_count' => rand(5, 30),
            ]);
        }
    }
}


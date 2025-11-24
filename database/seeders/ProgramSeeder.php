<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Category;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::where('name', 'Programs')->first();

        if (!$category) {
            return;
        }

        $programs = [
            [
                'title' => 'Mentorship Hub',
                'description' => "We match senior researchers and clinicians with young professionals to accelerate academic and clinical growth.\n\nFeatures:\n• Mentor–Mentee Matching Portal\n• Profile system by specialty, goals, and research interest\n• Progress tracking dashboard",
                'icon' => 'bi-people-fill', // bootstrap icon
                'featured' => true,
                'display_order' => 1,
            ],
            [
                'title' => 'Research & Data Support',
                'description' => "Services:\n• Data collection & management\n• Proposal and publication mentorship\n• Audit & survey design\n• Statistical analysis and visualization",
                'icon' => 'bi-bar-chart-line-fill',
                'featured' => false,
                'display_order' => 2,
            ],
            [
                'title' => 'Capacity Building Workshops',
                'description' => "Topics:\n• Research methods\n• Scientific writing\n• Data analysis\n• Ethics & IRB application\n\nFeature: Interactive Training Calendar with “Register Now” buttons.",
                'icon' => 'bi-journal-text',
                'featured' => false,
                'display_order' => 3,
            ],
            [
                'title' => 'Innovation Projects',
                'description' => "Examples:\n• Digital Mentorship Dashboard\n• Road Safety & Post-Crash Care Project\n• Rescue Sheet (English–Kinyarwanda) for emergency response",
                'icon' => 'bi-lightbulb-fill',
                'featured' => false,
                'display_order' => 4,
            ],
        ];

        foreach ($programs as $program) {
            Program::create([
                'title' => $program['title'],
                'category_id' => $category->id,
                'description' => $program['description'],
                'icon' => $program['icon'],
                'status' => 'published',
                'featured' => $program['featured'],
                'display_order' => $program['display_order'],
            ]);
        }
    }
}

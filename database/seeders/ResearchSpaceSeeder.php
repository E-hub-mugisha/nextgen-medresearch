<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResearchSpace;

class ResearchSpaceSeeder extends Seeder
{
    public function run(): void
    {
        ResearchSpace::create([
            'title' => 'Digital Health Solutions for Diabetes Management',
            'description' => 'This research focuses on the use of digital platforms to improve diabetes patient monitoring and treatment adherence.',
            'target_area' => 'Healthcare / Digital Health',
            'importance' => 'Supports improved patient outcomes and informed policy decisions.',
            'impact' => 'Enhanced efficiency in diabetes care delivery in low-resource settings.',
        ]);

        ResearchSpace::create([
            'title' => 'Artificial Intelligence in Academic Research',
            'description' => 'Explores how AI tools assist students and researchers in data analysis and literature review.',
            'target_area' => 'Education / Artificial Intelligence',
            'importance' => 'Improves research quality and reduces time spent on manual analysis.',
            'impact' => 'Increased productivity and innovation in higher education.',
        ]);
    }
}

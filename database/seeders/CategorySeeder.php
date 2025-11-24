<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Programs',
                'type' => 'program',
                'description' => 'Training, mentorship and research capacity building programs.',
            ],
            [
                'name' => 'Blog',
                'type' => 'post',
                'description' => 'Articles and updates on research and medical innovation.',
            ],
            [
                'name' => 'Success Stories',
                'type' => 'story',
                'description' => 'Impact stories and testimonials from community members.',
            ],
            [
                'name' => 'Resources',
                'type' => 'resource',
                'description' => 'Downloadable research papers, guides, templates and educational resources.',
            ],
            [
                'name' => 'Rescue Sheets',
                'type' => 'rescue',
                'description' => 'Vehicle rescue sheets with QR access for emergency response.',
            ],
            [
                'name' => 'Events & Workshops',
                'type' => 'event',
                'description' => 'Upcoming workshops, trainings and conferences.',
            ],
            [
                'name' => 'News & Updates',
                'type' => 'news',
                'description' => 'Platform news, announcements and media updates.',
            ],
            [
                'name' => 'Partners',
                'type' => 'partner',
                'description' => 'Organizations and institutions collaborating with us.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'type' => $category['type'],
                'description' => $category['description'],
                'status' => 'active',
            ]);
        }
    }
}

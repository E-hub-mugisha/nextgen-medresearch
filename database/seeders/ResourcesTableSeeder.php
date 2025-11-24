<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;
use App\Models\Category;

class ResourcesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure categories exist or create them
        $categories = [
            'reports' => Category::firstOrCreate(
                ['slug' => 'reports'],
                ['name' => 'Reports', 'status' => 'active']
            ),
            'guidelines' => Category::firstOrCreate(
                ['slug' => 'guidelines'],
                ['name' => 'Guidelines', 'status' => 'active']
            ),
            'training-materials' => Category::firstOrCreate(
                ['slug' => 'training-materials'],
                ['name' => 'Training Materials', 'status' => 'active']
            ),
        ];

        $resources = [
            [
                'title'         => 'Diabetes Awareness Training Manual',
                'file_path'     => 'resources/manuals/diabetes_training_manual.pdf',
                'description'   => 'A comprehensive guide for community health workers.',
                'category_id'   => $categories['training-materials']->id,
                'download_count'=> 120,
                'status'        => 'published',
            ],
            [
                'title'         => 'Annual Health Impact Report 2024',
                'file_path'     => 'resources/reports/impact_report_2024.pdf',
                'description'   => 'Annual report summarizing program outcomes and research findings.',
                'category_id'   => $categories['reports']->id,
                'download_count'=> 345,
                'status'        => 'published',
            ],
            [
                'title'         => 'Nutrition Guidelines for Diabetes',
                'file_path'     => 'resources/guidelines/nutrition_guidelines.pdf',
                'description'   => 'Recommended dietary practices for diabetic patients.',
                'category_id'   => $categories['guidelines']->id,
                'download_count'=> 89,
                'status'        => 'draft',
            ],
        ];

        foreach ($resources as $resource) {
            Resource::create($resource);
        }
    }
}

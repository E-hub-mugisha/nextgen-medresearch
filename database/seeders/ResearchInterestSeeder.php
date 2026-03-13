<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ResearchInterest;

class ResearchInterestSeeder extends Seeder
{
    public function run(): void
    {
        $topics = [
            'Science & Biology' => [
                'Genomics & Bioinformatics',
                'Molecular Biology',
                'Neuroscience',
                'Ecology & Conservation',
                'Microbiology',
                'Evolutionary Biology',
                'Cell Biology',
                'Biochemistry',
            ],
            'Medicine & Health' => [
                'Public Health',
                'Epidemiology',
                'Clinical Research',
                'Mental Health',
                'Pharmacology',
                'Medical Imaging',
                'Oncology',
                'Global Health',
            ],
            'Technology & Computing' => [
                'Machine Learning',
                'Deep Learning',
                'Natural Language Processing',
                'Computer Vision',
                'Cybersecurity',
                'Cloud Computing',
                'Robotics',
                'Quantum Computing',
            ],
            'Data & Statistics' => [
                'Data Science',
                'Biostatistics',
                'Statistical Modelling',
                'Data Visualization',
                'Big Data Analytics',
            ],
            'Engineering' => [
                'Biomedical Engineering',
                'Environmental Engineering',
                'Materials Science',
                'Electrical Engineering',
                'Chemical Engineering',
            ],
            'Social Sciences' => [
                'Sociology',
                'Psychology',
                'Economics',
                'Political Science',
                'Anthropology',
                'Education Research',
            ],
            'Earth & Environment' => [
                'Climate Science',
                'Oceanography',
                'Geoscience',
                'Environmental Policy',
                'Renewable Energy',
            ],
            'Interdisciplinary' => [
                'Science Communication',
                'Research Ethics',
                'Science Policy',
                'Digital Humanities',
                'Computational Social Science',
            ],
        ];

        foreach ($topics as $category => $names) {
            foreach ($names as $name) {
                ResearchInterest::updateOrCreate(
                    ['slug' => Str::slug($name)],
                    [
                        'name'     => $name,
                        'category' => $category,
                    ]
                );
            }
        }
    }
}
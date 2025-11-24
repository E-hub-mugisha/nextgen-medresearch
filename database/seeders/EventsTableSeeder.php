<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Category;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure categories exist
        $categories = [
            'workshops' => Category::firstOrCreate(
                ['slug' => 'workshops'],
                ['name' => 'Workshops', 'status' => 'active']
            ),
            'mentorship' => Category::firstOrCreate(
                ['slug' => 'mentorship'],
                ['name' => 'Mentorship', 'status' => 'active']
            ),
            'research-support' => Category::firstOrCreate(
                ['slug' => 'research-support'],
                ['name' => 'Research & Data Support', 'status' => 'active']
            ),
        ];

        $events = [
            [
                'title'             => 'Scientific Writing & Publication Workshop',
                'description'       => 'Hands-on training on writing manuscripts, selecting journals, and responding to peer reviewers.',
                'category_id'       => $categories['workshops']->id,
                'trainer'           => 'Dr. Alice Uwimana',
                'start_date'        => Carbon::now()->addDays(7),
                'end_date'          => Carbon::now()->addDays(9),
                'location'          => 'Kigali Convention Centre',
                'capacity'          => 60,
                'banner'            => 'events/banners/scientific_writing.png',
                'registration_link' => 'https://forms.gle/example1',
                'status'            => 'published',
                'publish_at'        => Carbon::now(),
            ],
            [
                'title'             => 'Mentorship Hub Orientation',
                'description'       => 'Introductory session for new mentees joining the mentorship program.',
                'category_id'       => $categories['mentorship']->id,
                'trainer'           => 'Prof. Jean Bosco',
                'start_date'        => Carbon::now()->addDays(14),
                'end_date'          => Carbon::now()->addDays(14),
                'location'          => 'University of Rwanda - College of Medicine',
                'capacity'          => 120,
                'banner'            => 'events/banners/mentorship_orientation.png',
                'registration_link' => 'https://forms.gle/example2',
                'status'            => 'scheduled',
                'publish_at'        => Carbon::now()->addDays(3),
            ],
            [
                'title'             => 'Data Analysis with SPSS & R',
                'description'       => 'Training on statistical analysis, data cleaning, and visualization using SPSS and R.',
                'category_id'       => $categories['research-support']->id,
                'trainer'           => 'Dr. Emmanuel Ndayishimiye',
                'start_date'        => Carbon::now()->subDays(10),
                'end_date'          => Carbon::now()->subDays(8),
                'location'          => 'Online (Zoom)',
                'capacity'          => 200,
                'banner'            => 'events/banners/data_analysis.png',
                'registration_link' => 'https://forms.gle/example3',
                'status'            => 'archived',
                'publish_at'        => Carbon::now()->subDays(15),
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Category;

class StoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        // Map categories by slug or create if missing
        $categories = [
            'success-stories' => Category::firstOrCreate(
                ['slug' => 'success-stories'],
                ['name' => 'Success Stories', 'status' => 'active']
            ),
            'testimonies' => Category::firstOrCreate(
                ['slug' => 'testimonies'],
                ['name' => 'Testimonies', 'status' => 'active']
            ),
        ];

        $stories = [
            [
                'name'        => 'John Doe',
                'title'       => 'From Diagnosis to Hope',
                'story'       => 'A powerful journey of resilience and recovery...',
                'image'       => 'stories/john.jpg',
                'video_url'   => 'https://www.youtube.com/watch?v=abc123',
                'category_id' => $categories['success-stories']->id,
                'status'      => 'published',
                'featured'    => true,
            ],
            [
                'name'        => 'Amina Uwase',
                'title'       => 'Living with Diabetes in Rwanda',
                'story'       => 'Amina shares her inspiring experience managing diabetes...',
                'image'       => 'stories/amina.jpg',
                'video_url'   => null,
                'category_id' => $categories['testimonies']->id,
                'status'      => 'published',
                'featured'    => false,
            ],
            [
                'name'        => 'Community Impact Program',
                'title'       => 'How Training Changed Lives',
                'story'       => 'A group testimony from community health workers...',
                'image'       => 'stories/community.jpg',
                'video_url'   => 'https://vimeo.com/123456',
                'category_id' => $categories['success-stories']->id,
                'status'      => 'draft',
                'featured'    => false,
            ],
        ];

        foreach ($stories as $story) {
            Story::create($story);
        }
    }
}

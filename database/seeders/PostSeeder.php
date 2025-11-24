<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $defaultUser = User::first();

        $posts = [
            [
                'title' => 'Launching the NextGen Mentorship Program',
                'category' => 'Programs',
                'excerpt' => 'Our mentorship program connects young clinicians with experienced researchers.',
                'content' => '<p>We are excited to announce the official launch of the NextGen Mentorship Program ...</p>',
                'featured' => true,
                'status' => 'published',
                'publish_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'How to Write a Research Proposal',
                'category' => 'Blog',
                'excerpt' => 'A step-by-step guide for beginners in research.',
                'content' => '<p>Writing a research proposal can feel overwhelming. This guide simplifies the process ...</p>',
                'featured' => true,
                'status' => 'published',
                'publish_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Success Story: First Publication from Our Cohort',
                'category' => 'Success Stories',
                'excerpt' => 'A mentee publishes their first peer-reviewed journal article.',
                'content' => '<p>Through mentorship and collaboration, our trainees achieve remarkable milestones ...</p>',
                'featured' => false,
                'status' => 'published',
                'publish_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'Download Research Templates and Tools',
                'category' => 'Resources',
                'excerpt' => 'Free downloadable research templates now available.',
                'content' => '<p>We have added new tools including proposal templates, survey forms ...</p>',
                'featured' => false,
                'status' => 'published',
                'publish_at' => Carbon::now(),
            ],
            [
                'title' => 'Upcoming Workshop: Data Analysis with SPSS',
                'category' => 'Events & Workshops',
                'excerpt' => 'Join our hands-on workshop to learn SPSS.',
                'content' => '<p>Register now for our upcoming SPSS data analysis workshop ...</p>',
                'featured' => false,
                'status' => 'scheduled',
                'publish_at' => Carbon::now()->addDays(3),
            ],
        ];

        foreach ($posts as $post) {

            $category = Category::where('name', $post['category'])->first();

            if (!$category) {
                continue; // skip if missing
            }

            Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']) . '-' . time(),
                'category_id' => $category->id,
                'excerpt' => $post['excerpt'],
                'content' => $post['content'],
                'featured_image' => null,
                'status' => $post['status'],
                'featured' => $post['featured'],
                'publish_at' => $post['publish_at'],
                'created_by' => $defaultUser?->id,
                'updated_by' => $defaultUser?->id,
            ]);
        }
    }
}

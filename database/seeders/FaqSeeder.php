<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What is NextGen MedResearch?',
                'answer' => 'It is a social innovation platform advancing mentorship, medical research, and capacity building across Africa.',
                'category' => 'general',
            ],
            [
                'question' => 'How can I become a member?',
                'answer' => 'You can apply through the membership page by completing the registration form.',
                'category' => 'membership',
            ],
            [
                'question' => 'How does the mentorship program work?',
                'answer' => 'Mentees are matched with expert mentors based on specialty, goals, and research interests through our digital hub.',
                'category' => 'mentorship',
            ],
            [
                'question' => 'Can institutions partner with NextGen?',
                'answer' => 'Yes, our partnership program supports training, research projects, data services, and skill development.',
                'category' => 'general',
            ],
            [
                'question' => 'Are the resources free to download?',
                'answer' => 'Most resources are free, but some advanced toolkits may require membership.',
                'category' => 'platform',
            ],
            [
                'question' => 'Do you support research data analysis?',
                'answer' => 'Yes, we provide data analysis, visualization, and publication mentorship services.',
                'category' => 'research',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'category' => $faq['category'],
                'status' => 'published',
                'featured' => $index < 3, // first 3 featured
                'display_order' => $index + 1,
            ]);
        }
    }
}


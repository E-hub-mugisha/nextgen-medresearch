<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MentorQuestion;
use App\Models\MentorAnswer;
use App\Models\MentorCategory;
use App\Models\User;

class MentorQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Create sample mentor
        $mentor = User::firstOrCreate(
            ['email' => 'mentor@example.com'],
            [
                'name' => 'Dr. Mentor',
                'password' => bcrypt('password'),
            ]
        );

        // Fetch categories (must exist)
        $clinical     = MentorCategory::where('slug', 'clinical-research')->first();
        $publishing   = MentorCategory::where('slug', 'publishing-journals')->first();
        $dataAnalysis = MentorCategory::where('slug', 'data-analysis')->first();

        // Fallback safety
        if (!$clinical || !$publishing || !$dataAnalysis) {
            $this->command->error('Mentor categories missing. Run MentorCategorySeeder first.');
            return;
        }

        // Sample questions
        $questions = [
            [
                'mentor_category_id' => $clinical->id,
                'user_id' => $user->id,
                'title' => 'How do I start a clinical research project?',
                'question' => 'I am a medical student and want to conduct my first research. What are the steps?',
                'status' => 'answered',
                'featured' => true,
            ],
            [
                'mentor_category_id' => $publishing->id,
                'user_id' => $user->id,
                'title' => 'Tips for publishing in international journals',
                'question' => 'What strategies can I use to get my research published in reputable journals?',
                'status' => 'answered',
                'featured' => false,
            ],
            [
                'mentor_category_id' => $dataAnalysis->id,
                'user_id' => $user->id,
                'title' => 'Data analysis for small datasets',
                'question' => 'Which statistical methods are suitable for small sample sizes?',
                'status' => 'pending',
                'featured' => false,
            ],
        ];

        foreach ($questions as $qData) {
            $question = MentorQuestion::firstOrCreate(
                ['title' => $qData['title']],
                $qData
            );

            // Add sample answer if answered
            if ($question->status === 'answered' && $question->answers()->count() === 0) {
                MentorAnswer::create([
                    'mentor_question_id' => $question->id,
                    'mentor_id' => $mentor->id,
                    'answer' =>
                        'Start by defining your research question clearly, conduct a literature review, ' .
                        'and draft a protocol. Consider finding a mentor early for guidance.',
                ]);
            }
        }
    }
}

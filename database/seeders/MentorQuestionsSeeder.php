<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MentorQuestion;
use App\Models\MentorAnswer;
use App\Models\User;

class MentorQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample users (if needed)
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        $mentor = User::firstOrCreate(
            ['email' => 'mentor@example.com'],
            ['name' => 'Dr. Mentor', 'password' => bcrypt('password')]
        );

        // Sample questions
        $questions = [
            [
                'user_id' => $user->id,
                'title' => 'How do I start a clinical research project?',
                'question' => 'I am a medical student and want to conduct my first research. What are the steps?',
                'status' => 'answered',
                'featured' => true,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Tips for publishing in international journals',
                'question' => 'What strategies can I use to get my research published in reputable journals?',
                'status' => 'answered',
                'featured' => false,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Data analysis for small datasets',
                'question' => 'Which statistical methods are suitable for small sample sizes?',
                'status' => 'pending',
                'featured' => false,
            ],
        ];

        foreach ($questions as $qData) {
            $question = MentorQuestion::create($qData);

            // Add sample answers for answered questions
            if ($question->status === 'answered') {
                MentorAnswer::create([
                    'mentor_question_id' => $question->id,
                    'mentor_id' => $mentor->id,
                    'answer' => 'Start by defining your research question clearly, conduct a literature review, and draft a protocol. Consider finding a mentor early for guidance.'
                ]);
            }
        }
    }
}

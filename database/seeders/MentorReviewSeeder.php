<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MentorReview;

class MentorReviewSeeder extends Seeder
{
    public function run(): void
    {
        $mentors = User::where('role', 'mentor')->get();
        $mentees = User::where('role', 'mentee')->get();

        $sampleReviews = [
            "Very helpful and knowledgeable.",
            "Provided great guidance for my research.",
            "Supportive and easy to communicate with.",
            "Excellent mentorship experience.",
            "Highly recommended for anyone seeking advice."
        ];

        foreach ($mentors as $mentor) {
            // Assign 2-5 random reviews per mentor
            $randomMentees = $mentees->random(rand(2));

            foreach ($randomMentees as $mentee) {
                MentorReview::updateOrCreate(
                    [
                        'mentor_id' => $mentor->id,
                        'mentee_id' => $mentee->id,
                    ],
                    [
                        'rating' => rand(3, 5),
                        'review' => $sampleReviews[array_rand($sampleReviews)],
                    ]
                );
            }
        }
    }
}

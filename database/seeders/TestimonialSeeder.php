<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        Testimonial::insert([
            [
                'name' => 'Dr. Keza Marie',
                'role' => 'Cardiologist',
                'organization' => 'Rwanda Cardiology Association',
                'testimonial' => 'Together, we’re strengthening Rwanda’s health research ecosystem.',
                'photo' => 'testimonials/keza.jpg',
                'rating' => 5,
                'featured' => true,
                'status' => 'published',
            ],
            [
                'name' => 'Prof. Nkurunziza John',
                'role' => 'Lecturer',
                'organization' => 'University of Rwanda',
                'testimonial' =>
                    'The mentorship and training provided by the platform have elevated our research capacity.',
                'photo' => 'testimonials/john.jpg',
                'rating' => 5,
                'featured' => false,
                'status' => 'published',
            ],
            [
                'name' => 'Dr. Diane Mukamana',
                'role' => 'Public Health Specialist',
                'organization' => 'Rwanda Biomedical Center (RBC)',
                'testimonial' =>
                    'An innovative platform that supports health professionals with quality research tools.',
                'photo' => 'testimonials/diane.jpg',
                'rating' => 4,
                'featured' => false,
                'status' => 'published',
            ],
        ]);
    }
}


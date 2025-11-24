<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnersSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Rwanda Cardiology Association',
                'logo' => 'partners/rwanda-cardiology.png',
                'testimonial' => 'Together, we’re strengthening Rwanda’s health research ecosystem.',
                'status' => 'active',
                'display_order' => 1
            ],
            [
                'name' => 'University of Rwanda',
                'logo' => 'partners/university-rwanda.png',
                'display_order' => 2
            ],
            [
                'name' => 'King Faisal Hospital',
                'logo' => 'partners/king-faisal.png',
                'display_order' => 3
            ],
            [
                'name' => 'NCD Alliance',
                'logo' => 'partners/ncd-alliance.png',
                'display_order' => 4
            ],
            [
                'name' => 'Rwanda Biomedical Center (RBC)',
                'logo' => 'partners/rbc.png',
                'display_order' => 5
            ],
        ];

        foreach ($partners as $p) {
            Partner::create($p);
        }
    }
}

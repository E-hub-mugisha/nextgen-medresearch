<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Category;

class ProjectsTableSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'innovation-projects'],
            ['name' => 'Innovation Projects', 'status' => 'active']
        );

        Project::create([
            'title'         => 'Rescue Sheet (English–Kinyarwanda)',
            'category_id'   => $category->id,
            'summary'       => 'A bilingual emergency rescue sheet designed to help first responders safely extract crash victims based on vehicle structure.',
            'description'   =>
                'This project develops and distributes bilingual rescue sheets for vehicles in Rwanda, helping firefighters, police, and emergency responders save lives by understanding vehicle construction, battery location, fuel lines, airbags, and high-voltage systems.',
            'banner'        => 'projects/banners/rescue_sheet.png',
            'project_link'  => url('/rescue'),
            'status'        => 'published',
            'featured'      => true,
            'display_order' => 1,
        ]);
    }
}

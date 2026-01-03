<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResearchKit;

class ResearchKitSeeder extends Seeder
{
    public function run(): void
    {
        ResearchKit::insert([
            [
                'title' => 'Clinical Research Starter Kit',
                'description' => 'A comprehensive starter kit covering clinical research fundamentals including study design, protocol development, informed consent templates, and basic data collection tools.',
                'status' => 'active',
                'display_order' => 1,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Systematic Review & Meta-Analysis Toolkit',
                'description' => 'Includes PRISMA checklists, literature search strategies, screening templates, data extraction sheets, and guidance for conducting systematic reviews and meta-analyses.',
                'status' => 'active',
                'display_order' => 2,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Biostatistics & Data Analysis Kit',
                'description' => 'Practical resources for medical data analysis including sample size calculators, statistical analysis plans, SPSS/R code samples, and interpretation guides.',
                'status' => 'active',
                'display_order' => 3,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ethics & IRB Submission Kit',
                'description' => 'Templates and guidelines for ethical approval including IRB application forms, consent documents, participant information sheets, and ethical risk assessment tools.',
                'status' => 'active',
                'display_order' => 4,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Public Health Research Kit',
                'description' => 'Designed for population-based research with survey instruments, epidemiological study templates, data collection protocols, and reporting standards.',
                'status' => 'active',
                'display_order' => 5,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laboratory Research Documentation Kit',
                'description' => 'Standard operating procedures (SOPs), lab notebook templates, sample tracking logs, and quality control documentation for biomedical laboratories.',
                'status' => 'active',
                'display_order' => 6,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Grant Writing for Medical Research Kit',
                'description' => 'Step-by-step grant writing resources including proposal templates, budgeting tools, logical frameworks, and reviewer feedback examples.',
                'status' => 'active',
                'display_order' => 7,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Manuscript Writing & Publication Kit',
                'description' => 'Guidance for writing and publishing medical research papers including journal selection tips, manuscript templates, reporting guidelines, and peer-review response samples.',
                'status' => 'active',
                'display_order' => 8,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced Clinical Trials Toolkit',
                'description' => 'Advanced tools for randomized controlled trials covering trial registration, monitoring plans, adverse event reporting, and regulatory compliance.',
                'status' => 'active',
                'display_order' => 9,
                'file_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

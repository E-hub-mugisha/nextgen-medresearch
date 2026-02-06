<?php

namespace Database\Seeders;

use App\Models\RescueSheet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RescueSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Cars
            ['title' => 'Toyota Corolla 2022 Rescue Sheet', 'vehicle_model' => 'Toyota Corolla 2022', 'category' => 'car'],
            ['title' => 'Honda Civic 2021 Rescue Sheet', 'vehicle_model' => 'Honda Civic 2021', 'category' => 'car'],
            ['title' => 'Hyundai Elantra 2023 Rescue Sheet', 'vehicle_model' => 'Hyundai Elantra 2023', 'category' => 'car'],

            // Trucks
            ['title' => 'Isuzu NPR Truck Rescue Sheet', 'vehicle_model' => 'Isuzu NPR', 'category' => 'truck'],
            ['title' => 'Ford F-150 Rescue Sheet', 'vehicle_model' => 'Ford F-150', 'category' => 'truck'],

            // Buses
            ['title' => 'Toyota Coaster Bus Rescue Sheet', 'vehicle_model' => 'Toyota Coaster', 'category' => 'bus'],
            ['title' => 'Yutong ZK Bus Rescue Sheet', 'vehicle_model' => 'Yutong ZK', 'category' => 'bus'],

            // EVs
            ['title' => 'Tesla Model 3 Rescue Sheet', 'vehicle_model' => 'Tesla Model 3', 'category' => 'ev'],
            ['title' => 'Nissan Leaf EV Rescue Sheet', 'vehicle_model' => 'Nissan Leaf', 'category' => 'ev'],
        ];

        foreach ($data as $item) {
            RescueSheet::create([
                'title'         => $item['title'],
                'vehicle_model' => $item['vehicle_model'],
                'category'      => $item['category'],
                'slug'          => Str::slug($item['title']) . '-' . rand(100, 999),
                'file_path'     => 'rescue_sheets/sample.pdf', // fake file path for testing
                'qr_code_path'  => 'qrcodes/sample.png',        // fake QR path
                'scan_count'    => rand(0, 50),
            ]);
        }
    }
}

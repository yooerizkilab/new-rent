<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            [
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'year' => 2020,
                'color' => 'White',
                'transmission' => 'Automatic',
                'fuel' => 'Gasoline',
                'mileage' => '15000',
                'baggage' => '3 bags',
                'seat' => '5 seats',
                'feature' => 'Air Conditioning, Bluetooth',
                'license_plate' => 'ABC123',
                'description' => 'Comfortable and fuel-efficient.',
                'image' => 'toyota_corolla.png',
                // 'units' => 5,
                'status' => 'available',
                'daily_rate' => 500000,
                'weekly_rate' => 3000000,
                'monthly_rate' => 10000000,
                'penalty_rate_per_day' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Honda',
                'model' => 'Civic',
                'year' => 2019,
                'color' => 'Black',
                'transmission' => 'Manual',
                'fuel' => 'Gasoline',
                'mileage' => '20000',
                'baggage' => '2 bags',
                'seat' => '5 seats',
                'feature' => 'Air Conditioning, GPS',
                'license_plate' => 'XYZ789',
                'description' => 'Sporty and stylish.',
                'image' => 'honda_civic.png',
                // 'units' => 3,
                'status' => 'available',
                'daily_rate' => 600000,
                'weekly_rate' => 3500000,
                'monthly_rate' => 12000000,
                'penalty_rate_per_day' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

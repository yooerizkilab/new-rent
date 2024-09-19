<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryLocationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('delivery_locations')->insert([
            [
                'booking_id' => 1,
                'address' => 'Jl. Kebon Jeruk No. 5, Jakarta',
                'latitude' => -6.176655,
                'longitude' => 106.828346,
                'delivery_date' => '2024-08-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'address' => 'Jl. Asia Afrika No. 8, Bandung',
                'latitude' => -6.914744,
                'longitude' => 107.609810,
                'delivery_date' => '2024-08-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

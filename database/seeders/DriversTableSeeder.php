<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriversTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('drivers')->insert([
            [
                'photo' => 'driver1.png',
                'name' => 'Driver A',
                'phone_number' => '081234567890',
                'license_number' => 'DL12345',
                'availability' => 'available',
                'rate_per_day' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'photo' => 'driver2.png',
                'name' => 'Driver B',
                'phone_number' => '081098765432',
                'license_number' => 'DL54321',
                'availability' => 'available',
                'rate_per_day' => 250000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

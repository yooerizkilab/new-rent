<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarDriversTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('car_drivers')->insert([
            [
                'car_id' => 1,
                'driver_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 2,
                'driver_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

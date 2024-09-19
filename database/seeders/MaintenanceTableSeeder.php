<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenanceTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('maintenance')->insert([
            [
                'car_id' => 1,
                'description' => 'Oil change and tire rotation',
                'maintenance_date' => '2024-08-01',
                'cost' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 2,
                'description' => 'Brake pad replacement',
                'maintenance_date' => '2024-08-05',
                'cost' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

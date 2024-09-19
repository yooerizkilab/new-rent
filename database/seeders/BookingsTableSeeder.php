<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('bookings')->insert([
            [
                'car_id' => 1,
                'customer_id' => 1,
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-05',
                'total_price' => 2500000,
                'status_price' => 'DP',
                'status' => 'booked',
                'driver_cost' => 200000,
                'fuel_cost' => 150000,
                'toll_cost' => 50000,
                'penalty_amount' => 0,
                'delivery_cost' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'car_id' => 2,
                'customer_id' => 2,
                'start_date' => '2024-08-10',
                'end_date' => '2024-08-15',
                'total_price' => 3000000,
                'status_price' => 'PAID',
                'status' => 'in_progress',
                'driver_cost' => 250000,
                'fuel_cost' => 180000,
                'toll_cost' => 60000,
                'penalty_amount' => 0,
                'delivery_cost' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

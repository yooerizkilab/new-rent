<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('promotion')->insert([
            [
                'code' => 'PROMO10',
                'description' => '10% discount for first-time customers',
                'discount_percentage' => 10.00,
                'start_date' => '2024-08-01',
                'end_date' => '2024-08-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PROMO20',
                'description' => '20% discount for rentals over 1 week',
                'discount_percentage' => 20.00,
                'start_date' => '2024-08-01',
                'end_date' => '2024-12-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

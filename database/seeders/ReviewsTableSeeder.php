<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('reviews')->insert([
            [
                'rental_id' => 1,
                'rating' => 5,
                'comment' => 'Excellent service!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rental_id' => 2,
                'rating' => 4,
                'comment' => 'Very good, but the car was a bit late.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

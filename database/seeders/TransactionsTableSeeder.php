<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('transactions')->insert([
            [
                'rental_id' => 1,
                'payment_method' => 'credit_card',
                'amount' => 2500000,
                'payment_date' => now(),
                'status' => 'completed',
                'snap_token' => 'snap-token-123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'rental_id' => 2,
                'payment_method' => 'bank_transfer',
                'amount' => 3000000,
                'payment_date' => now(),
                'status' => 'completed',
                'snap_token' => 'snap-token-456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

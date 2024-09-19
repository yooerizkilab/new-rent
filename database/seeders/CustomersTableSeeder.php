<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'nik' => '1234567890123456',
                'name' => 'Alice Brown',
                'phone_number' => '081234567890',
                'email' => 'alice.brown@example.com',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'photo' => 'alice_brown.png',
                'photo_idcard' => 'alice_idcard.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '6543210987654321',
                'name' => 'Bob White',
                'phone_number' => '081098765432',
                'email' => 'bob.white@example.com',
                'address' => 'Jl. Sudirman No. 456, Bandung',
                'photo' => 'bob_white.png',
                'photo_idcard' => 'bob_idcard.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

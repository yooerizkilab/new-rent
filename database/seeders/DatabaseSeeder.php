<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            ItemSeeder::class,
            // CarsTableSeeder::class,
            // CustomersTableSeeder::class,
            // BookingsTableSeeder::class,
            // TransactionsTableSeeder::class,
            // MaintenanceTableSeeder::class,
            // ReviewsTableSeeder::class,
            // PromotionsTableSeeder::class,
            // DriversTableSeeder::class,
            // CarDriversTableSeeder::class,
            // DeliveryLocationsTableSeeder::class,
        ]);
    }
}

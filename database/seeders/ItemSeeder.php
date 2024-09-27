<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item')->insert([
            [
                'no_seri' => 'A12345',
                'nama' => 'Laptop Dell XPS 13',
                'jenis' => 'Elektronik',
                'grup' => 'Komputer',
                'satuan' => 'Unit',
                'kondisi' => 'Baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_seri' => 'B67890',
                'nama' => 'Printer HP LaserJet',
                'jenis' => 'Elektronik',
                'grup' => 'Perangkat Kantor',
                'satuan' => 'Unit',
                'kondisi' => 'Bekas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_seri' => 'C13579',
                'nama' => 'Proyektor Epson',
                'jenis' => 'Elektronik',
                'grup' => 'Peralatan Presentasi',
                'satuan' => 'Unit',
                'kondisi' => 'Baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_seri' => 'D24680',
                'nama' => 'Meja Kantor',
                'jenis' => 'Perabotan',
                'grup' => 'Furnitur',
                'satuan' => 'Unit',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_seri' => 'E11223',
                'nama' => 'Kursi Ergonomis',
                'jenis' => 'Perabotan',
                'grup' => 'Furnitur',
                'satuan' => 'Unit',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

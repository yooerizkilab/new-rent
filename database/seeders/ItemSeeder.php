<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert dummy data
        DB::table('item')->insert([
            [
                'no_seri' => Str::upper(Str::random(12)),
                'gambar' => 'item1.jpg',
                'nama' => 'Barang 1',
                'merk' => 'Merk A',
                'jenis' => 'Elektronik',
                'grup' => 'Gadget',
                'satuan' => 'Unit',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_seri' => Str::upper(Str::random(12)),
                'gambar' => 'item2.jpg',
                'nama' => 'Barang 2',
                'merk' => 'Merk B',
                'jenis' => 'Furnitur',
                'grup' => 'Peralatan',
                'satuan' => 'Set',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_seri' => Str::upper(Str::random(12)),
                'gambar' => 'item3.jpg',
                'nama' => 'Barang 3',
                'merk' => 'Merk C',
                'jenis' => 'Kendaraan',
                'grup' => 'Transportasi',
                'satuan' => 'Unit',
                'kondisi' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

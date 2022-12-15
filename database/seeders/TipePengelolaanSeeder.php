<?php

namespace Database\Seeders;

use App\Models\TipePengelolaan;
use Illuminate\Database\Seeder;

class TipePengelolaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipePengelolaan::insert([
            [
                'nama' => 'Barang Masuk',
                'tipe' => '+',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Barang Keluar',
                'tipe' => '-',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Barang Rusak',
                'tipe' => '-',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Pengelolaan;
use Illuminate\Database\Seeder;

class PengelolaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengelolaan::insert([
            'id_pengelolaan' => 'PL-000001',
            'id_item' => 1,
            'id_tipe_pengelolaan' => 1,
            'jumlah' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\MasterPengelolaan;
use Illuminate\Database\Seeder;

class MasterPengelolaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterPengelolaan::insert([
            'id_pengelolaan' => 'PL-000001',
            'nama_penanggung_jawab' => 'Budi',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

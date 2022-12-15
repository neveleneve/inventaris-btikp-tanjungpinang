<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(JenisItemSeeder::class);
        $this->call(TipePengelolaanSeeder::class);
        // dihapus pas running
        $this->call(ItemSeeder::class);
        $this->call(MasterPengelolaanSeeder::class);
        $this->call(PengelolaanSeeder::class);
    }
}

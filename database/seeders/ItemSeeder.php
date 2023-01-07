<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $jumlahitem = 20;
        $satuan = [
            'Unit', 'Pack', 'Set'
        ];

        for ($i = 0; $i < $jumlahitem; $i++) {
            Item::insert([
                'id_jenis_item' => rand(1, 3),
                'nama' => $faker->word(),
                'satuan' => $satuan[rand(0, 2)],
                'jumlah' => rand(0, 20),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}

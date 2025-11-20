<?php
// database/seeders/CreatePoskoBencanaDummy.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreatePoskoBencanaDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // JANGAN gunakan truncate(), tapi delete() saja
        DB::table('posko_bencana')->delete();

        // Ambil semua ID kejadian bencana
        $kejadianIds = DB::table('kejadian_bencana')->pluck('kejadian_id')->toArray();

        if (empty($kejadianIds)) {
            return;
        }

        $kotaIndonesia = ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Makassar', 'Palembang', 'Denpasar'];

        for ($i = 1; $i <= 200; $i++) {
            $kota = $faker->randomElement($kotaIndonesia);

            DB::table('posko_bencana')->insert([
                'kejadian_id' => $faker->randomElement($kejadianIds),
                'nama' => 'Posko ' . $faker->randomElement(['Utama', 'Bantuan', 'Evakuasi', 'Kesehatan']) . ' ' . $kota,
                'alamat' => 'Jl. ' . $faker->streetName . ' No. ' . $faker->buildingNumber . ', ' . $kota,
                'kontak' => '08' . $faker->randomElement([1,2,3,8,9]) . $faker->numerify('#########'),
                'penanggung_jawab' => $faker->name,
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}

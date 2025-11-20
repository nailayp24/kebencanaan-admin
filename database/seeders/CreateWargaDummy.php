<?php
// database/seeders/CreateWargaDummy.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateWargaDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        DB::table('warga')->delete();

        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaan = ['PNS', 'Karyawan Swasta', 'Wiraswasta', 'Petani', 'Nelayan', 'Pedagang', 'Buruh', 'Mahasiswa', 'Pelajar', 'Ibu Rumah Tangga'];

        for ($i = 1; $i <= 200; $i++) {
            DB::table('warga')->insert([
                'no_ktp' => $faker->numerify('################'),
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement($agama),
                'pekerjaan' => $faker->randomElement($pekerjaan),
                'telp' => '08' . $faker->randomElement([1,2,3,8,9]) . $faker->numerify('#########'),
                'email' => $faker->boolean(60) ? $faker->safeEmail() : null,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}

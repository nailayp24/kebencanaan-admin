<?php
// database/seeders/CreateDonasiBencanaDummy.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateDonasiBencanaDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        DB::table('donasi_bencana')->delete();

        $kejadianBencana = DB::table('kejadian_bencana')->get();
        $jenisDonasi = ['uang', 'barang', 'jasa'];

        foreach (range(1, 200) as $index) {
            $kejadian = $faker->randomElement($kejadianBencana);
            $jenis = $faker->randomElement($jenisDonasi);

            DB::table('donasi_bencana')->insert([
                'kejadian_id' => $kejadian->kejadian_id,
                'donatur_nama' => $faker->name(),
                'jenis' => $jenis,
                'nilai' => $jenis === 'uang' ? $faker->numberBetween(100000, 10000000) : null,
                'keterangan' => $this->generateKeteranganDonasi($jenis, $faker),
                'created_at' => $faker->dateTimeBetween($kejadian->tanggal, 'now'),
                'updated_at' => now(),
            ]);
        }
    }

    private function generateKeteranganDonasi($jenis, $faker)
    {
        $keteranganTemplates = [
            'uang' => [
                'Bantuan tunai untuk korban bencana',
                'Donasi tunai melalui transfer bank',
                'Bantuan dana darurat',
            ],
            'barang' => [
                'Paket sembako ' . $faker->numberBetween(10, 100) . ' buah',
                'Selimut dan alat tidur ' . $faker->numberBetween(5, 50) . ' set',
                'Obat-obatan dan P3K',
            ],
            'jasa' => [
                'Relawan medis ' . $faker->numberBetween(1, 10) . ' orang',
                'Tim evakuasi dan penyelamatan',
                'Layanan dapur umum',
            ]
        ];

        return $faker->randomElement($keteranganTemplates[$jenis]);
    }
}

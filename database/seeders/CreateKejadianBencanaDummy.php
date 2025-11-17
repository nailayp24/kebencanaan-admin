<?php
// database/seeders/CreateKejadianBencanaDummy.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateKejadianBencanaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        $jenisBencana = [
            'Banjir', 'Kebakaran', 'Tanah Longsor', 'Gempa Bumi',
            'Angin Topan', 'Kekeringan', 'Tsunami', 'Gunung Meletus'
        ];

        $statusKejadian = ['dilaporkan', 'diverifikasi', 'ditangani', 'selesai'];

        $kota = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar', 'Semarang', 'Yogyakarta', 'Denpasar'];
        $kecamatan = ['Pusat', 'Utara', 'Selatan', 'Timur', 'Barat', 'Tengah'];

        foreach (range(1, 15) as $index) {
            $jenis = $faker->randomElement($jenisBencana);
            $tanggal = $faker->dateTimeBetween('-6 months', 'now');
            $kotaPilihan = $faker->randomElement($kota);
            $kecamatanPilihan = $faker->randomElement($kecamatan);

            DB::table('kejadian_bencana')->insert([
                'jenis_bencana' => $jenis,
                'tanggal' => $tanggal,
                'lokasi_text' => "Jl. " . $faker->streetName() . " No. " . $faker->buildingNumber() .
                               ", Kelurahan " . $faker->citySuffix() .
                               ", Kecamatan " . $kecamatanPilihan .
                               ", Kota " . $kotaPilihan,
                'rt' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 5), 3, '0', STR_PAD_LEFT),
                'dampak' => $this->generateDampak($jenis, $faker),
                'status_kejadian' => $faker->randomElement($statusKejadian),
                'keterangan' => $faker->boolean(70) ? $faker->text(200) : null,
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
        }

        $this->command->info('15 data kejadian bencana dummy berhasil dibuat!');
    }

    private function generateDampak($jenisBencana, $faker)
    {
        $dampakTemplates = [
            'Banjir' => [
                '{{number}} rumah terendam',
                '{{number}} jiwa mengungsi',
                '{{number}} hektar sawah tergenang',
                'Tinggi air mencapai {{number}} meter'
            ],
            'Kebakaran' => [
                '{{number}} rumah hangus',
                '{{number}} korban luka-luka',
                'Kerugian material Rp {{number}} juta',
                '{{number}} unit kendaraan terbakar'
            ],
            'Tanah Longsor' => [
                '{{number}} rumah tertimbun',
                '{{number}} korban jiwa',
                'Jalan sepanjang {{number}} meter tertutup',
                '{{number}} keluarga terdampak'
            ],
            'Gempa Bumi' => [
                'Skala {{number}} SR',
                '{{number}} bangunan rusak',
                '{{number}} jiwa mengungsi',
                'Kekuatan {{number}} MMI'
            ]
        ];

        $template = $faker->randomElement($dampakTemplates[$jenisBencana] ?? ['{{number}} unit terdampak']);
        $number = $faker->numberBetween(1, 100);

        return str_replace('{{number}}', $number, $template);
    }
}

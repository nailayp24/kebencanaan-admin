<?php
// database/seeders/CreateKejadianBencanaDummy.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateKejadianBencanaDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // JANGAN gunakan truncate(), tapi delete() saja
        DB::table('kejadian_bencana')->delete();

        $jenisBencana = [
            'Banjir', 'Kebakaran', 'Tanah Longsor', 'Gempa Bumi',
            'Angin Topan', 'Kekeringan', 'Tsunami', 'Gunung Meletus'
        ];

        $statusKejadian = ['dilaporkan', 'diverifikasi', 'ditangani', 'selesai'];
        $kota = ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar', 'Semarang', 'Yogyakarta', 'Denpasar'];
        $kecamatan = ['Pusat', 'Utara', 'Selatan', 'Timur', 'Barat', 'Tengah'];

        foreach (range(1, 200) as $index) {
            $jenis = $faker->randomElement($jenisBencana);
            $tanggal = $faker->dateTimeBetween('-6 months', 'now');

            DB::table('kejadian_bencana')->insert([
                'jenis_bencana' => $jenis,
                'tanggal' => $tanggal,
                'lokasi_text' => "Jl. " . $faker->streetName() . " No. " . $faker->buildingNumber() .
                               ", Kelurahan " . $faker->citySuffix() .
                               ", Kecamatan " . $faker->randomElement($kecamatan) .
                               ", Kota " . $faker->randomElement($kota),
                'rt' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 5), 3, '0', STR_PAD_LEFT),
                'dampak' => $this->generateDampak($jenis, $faker),
                'status_kejadian' => $faker->randomElement($statusKejadian),
                'keterangan' => $faker->boolean(70) ? $faker->text(200) : null,
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);
        }
    }

    private function generateDampak($jenisBencana, $faker)
    {
        $dampakTemplates = [
            'Banjir' => ['{{number}} rumah terendam', '{{number}} jiwa mengungsi'],
            'Kebakaran' => ['{{number}} rumah hangus', '{{number}} korban luka-luka'],
            'Tanah Longsor' => ['{{number}} rumah tertimbun', '{{number}} korban jiwa'],
            'Gempa Bumi' => ['Skala {{number}} SR', '{{number}} bangunan rusak'],
            'Angin Topan' => ['{{number}} rumah rusak', '{{number}} pohon tumbang'],
            'Kekeringan' => ['{{number}} desa terdampak', '{{number}} hektar sawah gagal panen'],
            'Tsunami' => ['Tinggi gelombang {{number}} meter', '{{number}} bangunan hancur'],
            'Gunung Meletus' => ['Tinggi abu {{number}} meter', '{{number}} desa terkubur abu']
        ];

        $template = $faker->randomElement($dampakTemplates[$jenisBencana] ?? ['{{number}} unit terdampak']);
        $number = $faker->numberBetween(1, 100);
        return str_replace('{{number}}', $number, $template);
    }
}

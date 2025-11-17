<?php
// database/seeders/CreateDonasiBencanaDummy.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CreateDonasiBencanaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Ambil semua kejadian bencana yang sudah ada
        $kejadianBencana = DB::table('kejadian_bencana')->get();

        $jenisDonasi = ['uang', 'barang', 'jasa'];

        $perusahaan = [
            'PT. Sumber Makmur', 'CV. Sejahtera Abadi', 'PT. Jaya Sentosa',
            'UD. Berkah Jaya', 'PT. Andalan Nusantara', 'CV. Maju Terus',
            'PT. Bumi Hijau', 'CV. Cemerlang Jaya', 'PT. Sinar Mas',
            'UD. Makmur Sentosa'
        ];

        $yayasan = [
            'Yayasan Peduli Sesama', 'Yayasan Bantuan Sosial', 'Yayasan Cinta Kasih',
            'Yayasan Harapan Bangsa', 'Yayasan Dana Sosial', 'Yayasan Bumi Lestari',
            'Yayasan Anak Bangsa', 'Yayasan Kemanusiaan', 'Yayasan Sahabat Masyarakat'
        ];

        $individu = $this->generateNamaIndividu($faker, 20);

        foreach (range(1, 30) as $index) {
            $kejadian = $faker->randomElement($kejadianBencana);
            $jenis = $faker->randomElement($jenisDonasi);

            // Tentukan jenis donatur
            $tipeDonatur = $faker->randomElement(['perusahaan', 'yayasan', 'individu']);

            switch ($tipeDonatur) {
                case 'perusahaan':
                    $donaturNama = $faker->randomElement($perusahaan);
                    break;
                case 'yayasan':
                    $donaturNama = $faker->randomElement($yayasan);
                    break;
                default:
                    $donaturNama = $faker->randomElement($individu);
                    break;
            }

            // Generate nilai donasi berdasarkan jenis
            $nilai = $this->generateNilaiDonasi($jenis, $faker, $tipeDonatur);

            $keterangan = $this->generateKeteranganDonasi($jenis, $faker);

            $tanggalDonasi = $faker->dateTimeBetween($kejadian->tanggal, 'now');

            DB::table('donasi_bencana')->insert([
                'kejadian_id' => $kejadian->kejadian_id,
                'donatur_nama' => $donaturNama,
                'jenis' => $jenis,
                'nilai' => $nilai,
                'keterangan' => $keterangan,
                'created_at' => $tanggalDonasi,
                'updated_at' => $tanggalDonasi,
            ]);
        }

        $this->command->info('30 data donasi bencana dummy berhasil dibuat!');
    }

    private function generateNamaIndividu($faker, $jumlah)
    {
        $nama = [];
        for ($i = 0; $i < $jumlah; $i++) {
            $nama[] = $faker->name();
        }
        return $nama;
    }

    private function generateNilaiDonasi($jenis, $faker, $tipeDonatur)
    {
        if ($jenis !== 'uang') {
            // Untuk barang dan jasa, beri nilai estimasi
            return $faker->randomElement([
                $faker->numberBetween(500000, 5000000),
                $faker->numberBetween(1000000, 10000000),
                $faker->numberBetween(5000000, 50000000)
            ]);
        }

        // Untuk donasi uang, sesuaikan dengan tipe donatur
        switch ($tipeDonatur) {
            case 'perusahaan':
                return $faker->numberBetween(10000000, 500000000);
            case 'yayasan':
                return $faker->numberBetween(5000000, 100000000);
            default: // individu
                return $faker->numberBetween(50000, 5000000);
        }
    }

    private function generateKeteranganDonasi($jenis, $faker)
    {
        $keteranganTemplates = [
            'uang' => [
                'Bantuan tunai untuk korban bencana',
                'Donasi tunai melalui transfer bank',
                'Bantuan dana darurat',
                'Sumbangan untuk rehabilitasi pasca bencana'
            ],
            'barang' => [
                'Paket sembako {{number}} buah',
                'Selimut dan alat tidur {{number}} set',
                'Obat-obatan dan P3K',
                'Pakaian layak pakai {{number}} kardus'
            ],
            'jasa' => [
                'Relawan medis {{number}} orang',
                'Tim evakuasi dan penyelamatan',
                'Konseling trauma pasca bencana',
                'Layanan dapur umum'
            ]
        ];

        $template = $faker->randomElement($keteranganTemplates[$jenis]);

        if (strpos($template, '{{number}}') !== false) {
            $number = $faker->numberBetween(10, 500);
            return str_replace('{{number}}', $number, $template);
        }

        return $template;
    }
}
